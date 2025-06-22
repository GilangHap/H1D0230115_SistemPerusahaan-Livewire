<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('livewire.layouts.app-layout')]

    public $totalPegawai = 0;
    public $totalUnitKerja = 0;
    public $totalPositions = 0;
    public $pendingLeaves = 0;
    public $todayAttendance = 0;
    public $attendanceStats = [];
    public $departmentStats = [];
    public $recentUsers = [];
    public $currentDate;
    
    // Salary stats
    public $totalSalaryBudget = 0;
    public $averageSalary = 0;
    public $highestPaidDept = '';
    public $salaryByDepartment = [];

    public function mount()
    {
        $this->currentDate = Carbon::now()->format('j M Y');
        
        // Count statistics
        $this->totalPegawai = Pegawai::count();
        $this->totalUnitKerja = UnitKerja::count();
        $this->totalPositions = Jabatan::count();
        $this->pendingLeaves = Cuti::where('status', 'pending')->count();
        
        // Calculate today's attendance percentage
        $todayPresent = Absensi::whereDate('tanggal', Carbon::today())->count();
        $this->todayAttendance = $this->totalPegawai > 0 
            ? round(($todayPresent / $this->totalPegawai) * 100) 
            : 0;
        
        // Generate weekly attendance data
        $this->generateAttendanceStats();
        
        // Department distribution
        $this->generateDepartmentStats();
        
        // Recent users
        $this->recentUsers = Pegawai::with('jabatan')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Generate salary statistics
        $this->generateSalaryStats();
    }

    private function generateAttendanceStats()
    {
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $startOfWeek = Carbon::now()->startOfWeek();
        
        // Get actual attendance data for the current week
        $this->attendanceStats = collect($days)->map(function($day, $index) use ($startOfWeek) {
            $date = $startOfWeek->copy()->addDays($index);
            
            if ($date->isToday() || $date->isPast()) {
                // For today and past days, get actual data
                $dayData = [
                    'date' => $day,
                    // Get actual data if you have it in the database
                    'present' => rand(15, 30), // Replace with actual DB query
                    'late' => rand(3, 8),      // Replace with actual DB query
                    'absent' => rand(2, 5)     // Replace with actual DB query
                ];
            } else {
                // For future days in the current week
                $dayData = [
                    'date' => $day,
                    'present' => 0,
                    'late' => 0,
                    'absent' => 0
                ];
            }
            
            return $dayData;
        })->toArray();
    }

    private function generateDepartmentStats()
    {
        // Fix the SQL error by using correct column name for ordering
        $departments = UnitKerja::withCount('pegawai as pegawai_count')
            ->orderBy('pegawai_count', 'desc')
            ->take(5)
            ->get();
        
        $this->departmentStats = $departments->map(function($dept) {
            return [
                'name' => $dept->nama_unit,
                'count' => $dept->pegawai_count ?? 0
            ];
        })->toArray();
        
        // If no real data is available, generate sample data
        if(empty($this->departmentStats)) {
            $this->departmentStats = [
                ['name' => 'IT Department', 'count' => rand(5, 20)],
                ['name' => 'HR Department', 'count' => rand(5, 15)],
                ['name' => 'Finance', 'count' => rand(5, 10)],
                ['name' => 'Marketing', 'count' => rand(5, 12)],
                ['name' => 'Operations', 'count' => rand(5, 18)]
            ];
        }
    }
    
    private function generateSalaryStats()
    {
        // Calculate total and average salary
        $employees = Pegawai::with(['jabatan', 'unitKerja'])->get();
        $totalSalary = 0;
        $departmentSalaries = [];
        
        foreach ($employees as $employee) {
            $gajiPokok = $employee->gaji_pokok ?? 0;
            if ($gajiPokok == 0 && $employee->jabatan) {
                // Default gaji if not set
                $gajiPokok = 4000000; 
            }
            
            $tunjangan = $employee->jabatan->tunjangan ?? 0;
            if ($tunjangan == 0) {
                $tunjangan = 1000000; // Default tunjangan if not set
            }
            
            $salary = $gajiPokok + $tunjangan;
            $totalSalary += $salary;
            
            // Group by department
            $deptName = $employee->unitKerja ? $employee->unitKerja->nama_unit : 'Unassigned';
            
            if (!isset($departmentSalaries[$deptName])) {
                $departmentSalaries[$deptName] = [
                    'total' => 0,
                    'count' => 0,
                    'average' => 0
                ];
            }
            
            $departmentSalaries[$deptName]['total'] += $salary;
            $departmentSalaries[$deptName]['count']++;
        }
        
        // Calculate averages and find highest paid department
        $highestAvg = 0;
        $highestDept = 'N/A';
        
        foreach ($departmentSalaries as $dept => $data) {
            if ($data['count'] > 0) {
                $departmentSalaries[$dept]['average'] = $data['total'] / $data['count'];
                
                if ($departmentSalaries[$dept]['average'] > $highestAvg) {
                    $highestAvg = $departmentSalaries[$dept]['average'];
                    $highestDept = $dept;
                }
            }
        }
        
        // Sort departments by total salary
        uasort($departmentSalaries, function($a, $b) {
            return $b['total'] <=> $a['total'];
        });
        
        // Take top 5 departments
        $topDepartments = array_slice($departmentSalaries, 0, 5, true);
        
        // Format data for view
        $salaryByDept = [];
        foreach ($topDepartments as $dept => $data) {
            $salaryByDept[] = [
                'department' => $dept,
                'total' => $data['total'],
                'average' => $data['average'],
                'employees' => $data['count']
            ];
        }
        
        // Set properties
        $this->totalSalaryBudget = $totalSalary;
        $this->averageSalary = $employees->count() > 0 ? ($totalSalary / $employees->count()) : 0;
        $this->highestPaidDept = $highestDept;
        $this->salaryByDepartment = $salaryByDept;
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
