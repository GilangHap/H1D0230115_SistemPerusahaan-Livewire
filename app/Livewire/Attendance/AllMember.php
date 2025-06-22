<?php

namespace App\Livewire\Attendance;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AllMember extends Component
{
    use WithPagination;
    
    #[Layout('livewire.layouts.app-layout')]
    
    public $search = '';
    public $statusFilter = '';
    public $departmentFilter = '';
    public $dateFilter = 'today';
    public $customDateStart;
    public $customDateEnd;
    public $sortField = 'tanggal';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $dateRange = [];
    
    // Detail modal properties
    public $showDetailModal = false;
    public $selectedAttendance = null;
    public $selectedEmployeeId = null;
    public $selectedDate = null;
    public $isLeave = false;
    public $leaveData = null;
    
    // Summary stats
    public $presentCount = 0;
    public $lateCount = 0;
    public $absentCount = 0;
    public $leaveCount = 0;
    public $departmentStats = [];
    
    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'departmentFilter' => ['except' => ''],
        'dateFilter' => ['except' => 'today'],
        'sortField' => ['except' => 'tanggal'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->customDateStart = Carbon::now()->format('Y-m-d');
        $this->customDateEnd = Carbon::now()->format('Y-m-d');
        $this->setDateRange();
    }
    
    public function render()
    {
        // Set date range based on filter
        $this->setDateRange();
        $startDate = $this->dateRange[0];
        $endDate = $this->dateRange[1];
        
        // Get all employees except admin/managers (role_id 1 and 2)
        $employeesQuery = Pegawai::whereHas('jabatan', function($q) {
            $q->whereNotIn('role_id', [1, 2]); // Exclude admin and manager roles
        });
        
        if (!empty($this->search)) {
            $employeesQuery->where(function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nip', 'like', '%' . $this->search . '%');
            });
        }
        
        if (!empty($this->departmentFilter)) {
            $employeesQuery->where('unit_kerja_id', $this->departmentFilter);
        }
        
        $employees = $employeesQuery->with(['jabatan', 'unitKerja'])->get();
        $employeeIds = $employees->pluck('id')->toArray();
        
        // Get leave data for the date range
        $leaveData = $this->getLeaveData($employeeIds, $startDate, $endDate);
        
        // Get all attendance records for the date range
        $attendanceRecords = Absensi::whereIn('pegawai_id', $employeeIds)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get()->keyBy(function($item) {
                return $item->pegawai_id . '_' . $item->tanggal;
            });
        
        // Create a collection to hold all attendance data
        $allAttendanceData = new Collection();
        
        // Focus on the current date range only
        $currentDate = Carbon::parse($startDate);
        $lastDate = Carbon::parse($endDate);
        
        // For each date in the range
        while ($currentDate->lte($lastDate)) {
            $currentDateStr = $currentDate->format('Y-m-d');
            
            // For all employees
            foreach ($employees as $employee) {
                $employeeId = $employee->id;
                
                // Check if employee is on leave for this date
                $isOnLeave = false;
                $leaveId = null;
                foreach ($leaveData as $leave) {
                    if ($leave->pegawai_id == $employeeId) {
                        $leaveStart = Carbon::parse($leave->tanggal_mulai);
                        $leaveEnd = Carbon::parse($leave->tanggal_akhir);
                        
                        if ($currentDate->betweenIncluded($leaveStart, $leaveEnd) && $leave->status === 'approved') {
                            $isOnLeave = true;
                            $leaveId = $leave->id;
                            break;
                        }
                    }
                }
                
                // Key for attendance lookup
                $attendanceKey = $employeeId . '_' . $currentDateStr;
                
                // If this employee has an attendance record for this date
                if ($attendanceRecords->has($attendanceKey)) {
                    $record = $attendanceRecords[$attendanceKey];
                    
                    // Add the employee data to the record
                    $record->pegawai = $employee;
                    
                    // Check for late status (after 8 AM)
                    if ($record->jam_masuk) {
                        $checkInTime = Carbon::createFromFormat('H:i:s', $record->jam_masuk);
                        $lateThreshold = Carbon::createFromFormat('H:i:s', '08:00:00');
                        
                        if ($checkInTime->gt($lateThreshold)) {
                            $record->status = 'terlambat';
                        } elseif ($record->status !== 'terlambat') {
                            $record->status = 'hadir';
                        }
                    }
                    
                    $allAttendanceData->push($record);
                } 
                // If on leave
                else if ($isOnLeave) {
                    $leaveAttendance = new Absensi();
                    $leaveAttendance->id = 'leave_' . $leaveId;
                    $leaveAttendance->pegawai_id = $employeeId;
                    $leaveAttendance->tanggal = $currentDateStr;
                    $leaveAttendance->status = 'cuti';
                    $leaveAttendance->pegawai = $employee;
                    $allAttendanceData->push($leaveAttendance);
                } 
                // If no record and not on leave
                else {
                    $absentAttendance = new Absensi();
                    $absentAttendance->id = 'absent_' . $employeeId . '_' . $currentDateStr;
                    $absentAttendance->pegawai_id = $employeeId;
                    $absentAttendance->tanggal = $currentDateStr;
                    $absentAttendance->status = 'tidak_hadir';
                    $absentAttendance->pegawai = $employee;
                    $allAttendanceData->push($absentAttendance);
                }
            }
            
            $currentDate->addDay();
        }
        
        // Apply status filter
        if (!empty($this->statusFilter)) {
            if ($this->statusFilter === 'present') {
                $allAttendanceData = $allAttendanceData->filter(function ($item) {
                    return $item->status === 'hadir';
                });
            } elseif ($this->statusFilter === 'late') {
                $allAttendanceData = $allAttendanceData->filter(function ($item) {
                    return $item->status === 'terlambat';
                });
            } elseif ($this->statusFilter === 'absent') {
                $allAttendanceData = $allAttendanceData->filter(function ($item) {
                    return $item->status === 'tidak_hadir';
                });
            } elseif ($this->statusFilter === 'leave') {
                $allAttendanceData = $allAttendanceData->filter(function ($item) {
                    return $item->status === 'cuti';
                });
            }
        }
        
        // Sort the data
        if ($this->sortField === 'tanggal') {
            $allAttendanceData = $allAttendanceData->sortBy([
                [$this->sortField, $this->sortDirection === 'asc' ? 'asc' : 'desc'],
                ['pegawai.nama', 'asc']
            ]);
        } else if (in_array($this->sortField, ['jam_masuk', 'jam_pulang'])) {
            $allAttendanceData = $allAttendanceData->sortBy([
                [$this->sortField, $this->sortDirection === 'asc' ? 'asc' : 'desc'],
                ['tanggal', 'asc'],
                ['pegawai.nama', 'asc']
            ]);
        } else if ($this->sortField === 'department') {
            $allAttendanceData = $allAttendanceData->sortBy([
                ['pegawai.unit_kerja_id', $this->sortDirection === 'asc' ? 'asc' : 'desc'],
                ['pegawai.nama', 'asc']
            ]);
        } else {
            $allAttendanceData = $allAttendanceData->sortBy([
                ['tanggal', $this->sortDirection === 'asc' ? 'asc' : 'desc'],
                ['pegawai.nama', 'asc']
            ]);
        }
        
        // Calculate overall stats
        $this->calculateStats($employeeIds, $leaveData);
        
        // Calculate department-specific stats
        $this->calculateDepartmentStats($startDate, $endDate);
        
        // Manually paginate
        $page = $this->page ?? 1;
        $perPage = $this->perPage;
        $items = $allAttendanceData->forPage($page, $perPage);
        
        // Create a LengthAwarePaginator instance
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $allAttendanceData->count(),
            $perPage,
            $page,
            ['path' => \Illuminate\Support\Facades\Request::url(), 'query' => \Illuminate\Support\Facades\Request::query()]
        );
        
        $departments = UnitKerja::orderBy('nama_unit')->get();
        
        return view('livewire.attendance.all-member', [
            'attendances' => $paginator,
            'employees' => $employees,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'departments' => $departments
        ]);
    }
    
    public function calculateStats($employeeIds, $leaveData)
    {
        $this->setDateRange();
        $startDate = $this->dateRange[0];
        $endDate = $this->dateRange[1];
        
        // Get attendance records for the stats
        $attendances = Absensi::whereIn('pegawai_id', $employeeIds)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get();
        
        // Calculate present and late count
        $this->presentCount = 0;
        $this->lateCount = 0;
        
        foreach ($attendances as $attendance) {
            if ($attendance->jam_masuk) {
                $checkInTime = Carbon::createFromFormat('H:i:s', $attendance->jam_masuk);
                $lateThreshold = Carbon::createFromFormat('H:i:s', '08:00:00');
                
                if ($checkInTime->gt($lateThreshold)) {
                    $this->lateCount++;
                } else {
                    $this->presentCount++;
                }
            } else if ($attendance->status === 'hadir') {
                $this->presentCount++;
            }
        }
        
        // Count leave days within the date range
        $this->leaveCount = 0;
        $startDateObj = Carbon::parse($startDate);
        $endDateObj = Carbon::parse($endDate);
        
        foreach ($leaveData as $leave) {
            if ($leave->status !== 'approved') continue;
            
            $leaveStart = max($startDateObj, Carbon::parse($leave->tanggal_mulai));
            $leaveEnd = min($endDateObj, Carbon::parse($leave->tanggal_akhir));
            
            // Count days in leave period
            for ($date = $leaveStart->copy(); $date->lte($leaveEnd); $date->addDay()) {
                $this->leaveCount++;
            }
        }
        
        // For absent, calculate based on total potential days minus present, late, and leave days
        $totalDays = $endDateObj->diffInDays($startDateObj) + 1;
        $totalPossibleAttendances = count($employeeIds) * $totalDays;
        $actualAttendances = $this->presentCount + $this->lateCount + $this->leaveCount;
        
        $this->absentCount = max(0, $totalPossibleAttendances - $actualAttendances);
    }

    public function calculateDepartmentStats($startDate, $endDate)
    {
        $departments = UnitKerja::all();
        $this->departmentStats = [];

        foreach ($departments as $department) {
            // Get employees in this department (excluding admins/managers)
            $employeeIds = Pegawai::where('unit_kerja_id', $department->id)
                ->whereHas('jabatan', function($q) {
                    $q->whereNotIn('role_id', [1, 2]); // Exclude admin and manager roles
                })
                ->pluck('id')
                ->toArray();

            if (empty($employeeIds)) {
                $this->departmentStats[$department->id] = [
                    'name' => $department->nama_unit,
                    'present' => 0,
                    'late' => 0,
                    'absent' => 0, 
                    'leave' => 0,
                    'total_staff' => 0
                ];
                continue;
            }

            // Count staff
            $staffCount = count($employeeIds);

            // Get attendances
            $attendances = Absensi::whereIn('pegawai_id', $employeeIds)
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->get();

            $presentCount = 0;
            $lateCount = 0;

            foreach ($attendances as $attendance) {
                if ($attendance->jam_masuk) {
                    $checkInTime = Carbon::createFromFormat('H:i:s', $attendance->jam_masuk);
                    $lateThreshold = Carbon::createFromFormat('H:i:s', '08:00:00');
                    
                    if ($checkInTime->gt($lateThreshold)) {
                        $lateCount++;
                    } else {
                        $presentCount++;
                    }
                } else if ($attendance->status === 'hadir') {
                    $presentCount++;
                }
            }

            // Get leave data
            $leaveData = Cuti::whereIn('pegawai_id', $employeeIds)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('tanggal_mulai', [$startDate, $endDate])
                        ->orWhereBetween('tanggal_akhir', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('tanggal_mulai', '<=', $startDate)
                              ->where('tanggal_akhir', '>=', $endDate);
                        });
                })
                ->where('status', 'approved')
                ->get();
            
            // Count leave days
            $leaveCount = 0;
            $startDateObj = Carbon::parse($startDate);
            $endDateObj = Carbon::parse($endDate);
            
            foreach ($leaveData as $leave) {
                $leaveStart = max($startDateObj, Carbon::parse($leave->tanggal_mulai));
                $leaveEnd = min($endDateObj, Carbon::parse($leave->tanggal_akhir));
                
                for ($date = $leaveStart->copy(); $date->lte($leaveEnd); $date->addDay()) {
                    $leaveCount++;
                }
            }

            // Calculate absent count
            $totalDays = Carbon::parse($endDate)->diffInDays(Carbon::parse($startDate)) + 1;
            $totalPossibleAttendances = $staffCount * $totalDays;
            $actualAttendances = $presentCount + $lateCount + $leaveCount;
            $absentCount = max(0, $totalPossibleAttendances - $actualAttendances);

            $this->departmentStats[$department->id] = [
                'name' => $department->nama_unit,
                'present' => $presentCount,
                'late' => $lateCount,
                'absent' => $absentCount,
                'leave' => $leaveCount,
                'total_staff' => $staffCount
            ];
        }
    }
    
    public function getLeaveData($employeeIds, $startDate, $endDate)
    {
        return Cuti::whereIn('pegawai_id', $employeeIds)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_mulai', [$startDate, $endDate])
                    ->orWhereBetween('tanggal_akhir', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('tanggal_mulai', '<=', $startDate)
                          ->where('tanggal_akhir', '>=', $endDate);
                    });
            })
            ->where('status', 'approved')
            ->with('pegawai')
            ->get();
    }
    
    public function setDateRange()
    {
        $now = Carbon::now();
        
        switch ($this->dateFilter) {
            case 'today':
                $this->dateRange = [
                    $now->format('Y-m-d'),
                    $now->format('Y-m-d')
                ];
                break;
                
            case 'yesterday':
                $yesterday = $now->copy()->subDay();
                $this->dateRange = [
                    $yesterday->format('Y-m-d'),
                    $yesterday->format('Y-m-d')
                ];
                break;
                
            case 'this_week':
                $this->dateRange = [
                    $now->copy()->startOfWeek()->format('Y-m-d'),
                    $now->copy()->endOfWeek()->format('Y-m-d')
                ];
                break;
                
            case 'last_week':
                $lastWeek = $now->copy()->subWeek();
                $this->dateRange = [
                    $lastWeek->startOfWeek()->format('Y-m-d'),
                    $lastWeek->endOfWeek()->format('Y-m-d')
                ];
                break;
                
            case 'this_month':
                $this->dateRange = [
                    $now->copy()->startOfMonth()->format('Y-m-d'),
                    $now->copy()->endOfMonth()->format('Y-m-d')
                ];
                break;
                
            case 'last_month':
                $lastMonth = $now->copy()->subMonth();
                $this->dateRange = [
                    $lastMonth->startOfMonth()->format('Y-m-d'),
                    $lastMonth->endOfMonth()->format('Y-m-d')
                ];
                break;
                
            case 'custom':
                if ($this->customDateStart && $this->customDateEnd) {
                    $this->dateRange = [
                        $this->customDateStart,
                        $this->customDateEnd
                    ];
                } else {
                    $this->dateRange = [
                        $now->format('Y-m-d'),
                        $now->format('Y-m-d')
                    ];
                }
                break;
                
            default:
                $this->dateRange = [
                    $now->format('Y-m-d'),
                    $now->format('Y-m-d')
                ];
        }
    }
    
    public function updatedDateFilter()
    {
        $this->setDateRange();
    }
    
    public function updatedCustomDateStart()
    {
        if ($this->dateFilter === 'custom') {
            $this->setDateRange();
        }
    }
    
    public function updatedCustomDateEnd()
    {
        if ($this->dateFilter === 'custom') {
            $this->setDateRange();
        }
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function resetFilters()
    {
        $this->reset(['search', 'statusFilter', 'departmentFilter']);
        $this->dateFilter = 'today';
        $this->customDateStart = Carbon::now()->format('Y-m-d');
        $this->customDateEnd = Carbon::now()->format('Y-m-d');
        $this->setDateRange();
        $this->resetPage();
    }
    
    public function showAttendanceDetail($id)
    {
        $this->isLeave = false;
        $this->leaveData = null;
        
        // Check if this is a leave record (id starts with "leave_")
        if (is_string($id) && strpos($id, 'leave_') === 0) {
            $leaveId = substr($id, 6); // Extract the leave ID
            $leave = Cuti::with(['pegawai', 'pegawai.jabatan', 'pegawai.unitKerja'])
                ->where('id', $leaveId)
                ->first();
                
            if (!$leave) {
                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'message' => 'Data cuti tidak ditemukan.'
                ]);
                return;
            }
            
            // Create a virtual attendance for leave display
            $attendance = new Absensi();
            $attendance->pegawai_id = $leave->pegawai_id;
            $attendance->pegawai = $leave->pegawai;
            $attendance->tanggal = $leave->tanggal_mulai;
            $attendance->status = 'cuti';
            $attendance->alasan = $leave->alasan;
            $attendance->leave_start = $leave->tanggal_mulai;
            $attendance->leave_end = $leave->tanggal_akhir;
            $attendance->leave_days = $leave->jumlah_hari;
            
            $this->selectedAttendance = $attendance;
            $this->isLeave = true;
            $this->leaveData = $leave;
            $this->showDetailModal = true;
            return;
        }
        // Check if this is an absent record (id starts with "absent_")
        else if (is_string($id) && strpos($id, 'absent_') === 0) {
            // Parse employee ID and date from the ID
            $parts = explode('_', substr($id, 7));
            if (count($parts) < 2) {
                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'message' => 'Format ID tidak valid.'
                ]);
                return;
            }
            
            $employeeId = $parts[0];
            $date = $parts[1];
            
            // Get employee data
            $employee = Pegawai::with(['jabatan', 'unitKerja'])
                ->where('id', $employeeId)
                ->first();
                
            if (!$employee) {
                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'message' => 'Data pegawai tidak ditemukan.'
                ]);
                return;
            }
            
            // Create a virtual attendance record for absent display
            $attendance = new Absensi();
            $attendance->pegawai_id = $employeeId;
            $attendance->pegawai = $employee;
            $attendance->tanggal = $date;
            $attendance->status = 'tidak_hadir';
            
            $this->selectedAttendance = $attendance;
            $this->showDetailModal = true;
            return;
        }
        
        // Regular attendance record
        try {
            $attendance = Absensi::with(['pegawai', 'pegawai.jabatan', 'pegawai.unitKerja'])
                ->where('id', $id)
                ->firstOrFail();
                
            // Check if it's late (after 8 AM)
            if ($attendance->jam_masuk) {
                $checkInTime = Carbon::createFromFormat('H:i:s', $attendance->jam_masuk);
                $lateThreshold = Carbon::createFromFormat('H:i:s', '08:00:00');
                
                if ($checkInTime->gt($lateThreshold)) {
                    $attendance->status = 'terlambat';
                } elseif ($attendance->status !== 'terlambat') {
                    $attendance->status = 'hadir';
                }
            }
            
            $this->selectedAttendance = $attendance;
            $this->showDetailModal = true;
            
        } catch (\Exception $e) {
            $this->dispatch('showAlert', type: 'error', message: 'Data absensi tidak ditemukan.');
        }
    }
    
    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedAttendance = null;
        $this->isLeave = false;
        $this->leaveData = null;
    }
    
    public function exportToExcel()
    {
        // Placeholder for future export functionality
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Ekspor data akan tersedia dalam update mendatang!'
        ]);
    }
    
    public function exportToPdf()
    {
        // Placeholder for future export functionality
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Ekspor PDF akan tersedia dalam update mendatang!'
        ]);
    }
}
