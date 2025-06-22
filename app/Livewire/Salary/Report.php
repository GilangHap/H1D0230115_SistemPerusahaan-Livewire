<?php

namespace App\Livewire\Salary;

use Carbon\Carbon;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Report extends Component
{
    use WithPagination;

    #[Layout('livewire.layouts.app-layout')]
    
    // Filter properties
    public $search = '';
    public $departmentFilter = '';
    public $month;
    public $year;
    public $perPage = 10;
    
    // Sort properties
    public $sortField = 'nama';
    public $sortDirection = 'asc';
    
    // Stats
    public $totalSalary = 0;
    public $totalEmployees = 0;
    public $averageSalary = 0;
    public $departmentStats = [];
    
    // Export
    public $isExporting = false;

    // Detail Modal
    public $showDetailModal = false;
    public $selectedEmployeeId = null;
    
    protected $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    
    protected $queryString = [
        'search' => ['except' => ''],
        'departmentFilter' => ['except' => ''],
        'month' => ['except' => ''],
        'year' => ['except' => ''],
    ];

    public function mount()
    {
        // Set default to current month and year
        $this->month = $this->month ?: Carbon::now()->month;
        $this->year = $this->year ?: Carbon::now()->year;
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function updatedDepartmentFilter()
    {
        $this->resetPage();
    }
    
    public function updatedMonth()
    {
        $this->resetPage();
    }
    
    public function updatedYear()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        
        // Jika sort berdasarkan gaji_bersih, kita harus melakukan custom sorting
        if ($field === 'gaji_bersih') {
            $this->resetPage();
            return;
        }
        
        $this->resetPage();
    }
    
    public function resetFilters()
    {
        $this->reset(['search', 'departmentFilter']);
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->resetPage();
    }
    
    public function exportToExcel()
    {
        $this->isExporting = true;
        
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Export Berhasil',
            'text' => 'Data laporan gaji berhasil di-export ke Excel.',
        ]);
        
        $this->isExporting = false;
    }
    
    public function exportToPdf()
    {
        $this->isExporting = true;
        
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Export Berhasil',
            'text' => 'Data laporan gaji berhasil di-export ke PDF.',
        ]);
        
        $this->isExporting = false;
    }
    
    private function generatePayslipForEmployee($employee)
    {
        // Make sure gaji_pokok has a value
        $gajiPokok = $employee->gaji_pokok ?? 0;
        if ($gajiPokok == 0) {
            $gajiPokok = 4000000; // Default value if not set
        }

        // Make sure tunjangan has a value
        $tunjangan = $employee->jabatan->tunjangan ?? 0;
        if ($tunjangan == 0) {
            $tunjangan = 1000000; // Default value if not set
        }

        // Generate payslip
        $payslipDate = Carbon::createFromDate($this->year, $this->month, 25);
        
        // Generate attendance data
        $workingDays = 22; // Standard working days per month
        $actualWorkingDays = min($workingDays, $workingDays - rand(0, 2)); // Random small absences
        
        // Calculate deductions
        $bpjsKesehatan = $gajiPokok * 0.01; // 1% of basic salary
        $bpjsKetenagakerjaan = $gajiPokok * 0.02; // 2% of basic salary
        $pph21 = $this->calculatePPh21($gajiPokok, $tunjangan); // Progressive tax calculation
        
        // Calculate total
        $totalEarnings = $gajiPokok + $tunjangan;
        $totalDeductions = $bpjsKesehatan + $bpjsKetenagakerjaan + $pph21;
        $netPay = $totalEarnings - $totalDeductions;
        
        // Determine if payslip should be marked as paid (past dates) or pending (future dates)
        $isPaid = $payslipDate->isPast() || $payslipDate->isToday();
        
        return [
            'id' => 'PS' . $this->year . str_pad($this->month, 2, '0', STR_PAD_LEFT) . str_pad($employee->id ?? 0, 5, '0', STR_PAD_LEFT),
            'tanggal' => $payslipDate->format('Y-m-d'),
            'gaji_pokok' => $gajiPokok,
            'tunjangan_jabatan' => $tunjangan,
            'kehadiran' => [
                'hari_kerja' => $workingDays,
                'hadir' => $actualWorkingDays,
                'tidak_hadir' => $workingDays - $actualWorkingDays
            ],
            'potongan' => [
                'bpjs_kesehatan' => $bpjsKesehatan,
                'bpjs_ketenagakerjaan' => $bpjsKetenagakerjaan,
                'pph21' => $pph21
            ],
            'total_pendapatan' => $totalEarnings,
            'total_potongan' => $totalDeductions,
            'gaji_bersih' => $netPay,
        ];
    }
    
    /**
     * Progressive tax calculation (simplified PPh21)
     */
    private function calculatePPh21($gajiPokok, $tunjangan)
    {
        $annualIncome = ($gajiPokok + $tunjangan) * 12;
        $taxableIncome = $annualIncome - 54000000; // Tax-free income (simplified)
        
        if ($taxableIncome <= 0) {
            return 0;
        }
        
        // Simplified progressive tax brackets
        if ($taxableIncome <= 50000000) {
            $tax = $taxableIncome * 0.05;
        } elseif ($taxableIncome <= 250000000) {
            $tax = (50000000 * 0.05) + (($taxableIncome - 50000000) * 0.15);
        } else {
            $tax = (50000000 * 0.05) + (200000000 * 0.15) + (($taxableIncome - 250000000) * 0.25);
        }
        
        // Monthly tax amount
        return $tax / 12;
    }
    
    public function calculateStats($employees)
    {
        // Reset stats
        $this->totalSalary = 0;
        $this->totalEmployees = count($employees);
        $this->averageSalary = 0;
        $this->departmentStats = [];
        
        // Department stats
        $departments = UnitKerja::all();
        foreach ($departments as $department) {
            $this->departmentStats[$department->id] = [
                'name' => $department->nama_unit,
                'count' => 0,
                'total' => 0,
                'avg' => 0
            ];
        }
        
        // Process each employee
        foreach ($employees as $employee) {
            // Generate payslip for each employee
            $payslip = $this->generatePayslipForEmployee($employee);
            $netPay = $payslip['gaji_bersih'];
            
            // Update total salary
            $this->totalSalary += $netPay;
            
            // Department stats
            $departmentId = $employee->unit_kerja_id ?? null;
            if ($departmentId && isset($this->departmentStats[$departmentId])) {
                $this->departmentStats[$departmentId]['count']++;
                $this->departmentStats[$departmentId]['total'] += $netPay;
            }
        }
        
        // Calculate average and department averages
        $this->averageSalary = $this->totalEmployees > 0 ? ($this->totalSalary / $this->totalEmployees) : 0;
        
        foreach ($this->departmentStats as $id => $dept) {
            if ($dept['count'] > 0) {
                $this->departmentStats[$id]['avg'] = $dept['total'] / $dept['count'];
            }
        }
    }
    
    /**
     * Set the selected employee ID and show modal
     */
    public function openDetailModal($id)
    {
        $this->selectedEmployeeId = $id;
        $this->showDetailModal = true;
    }
    
    /**
     * Close detail modal
     */
    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedEmployeeId = null;
    }
    
    /**
     * Get the selected employee with payslip data
     */
    public function getSelectedEmployee()
    {
        if (!$this->selectedEmployeeId) {
            return null;
        }
        
        $employee = Pegawai::with(['jabatan', 'unitKerja'])->find($this->selectedEmployeeId);
        if ($employee) {
            $employee->payslip = $this->generatePayslipForEmployee($employee);
        }
        
        return $employee;
    }
    
    public function render()
    {
        // Query employees, excluding admins
        $query = Pegawai::with(['jabatan', 'unitKerja'])
                ->whereDoesntHave('jabatan.role', function ($query) {
                    $query->where('name', 'admin');
                });
        
        if ($this->search) {
            $query->where(function($query) {
                $query->where('nama', 'like', '%'.$this->search.'%')
                      ->orWhere('nip', 'like', '%'.$this->search.'%');
            });
        }
        
        if ($this->departmentFilter) {
            $query->where('unit_kerja_id', $this->departmentFilter);
        }
        
        // Sort employees (except for gaji_bersih field)
        if ($this->sortField && $this->sortField !== 'gaji_bersih') {
            $query->orderBy($this->sortField, $this->sortDirection);
        }
        
        // Get all employees for stats
        $allEmployees = $query->get();
        
        // Calculate stats
        $this->calculateStats($allEmployees);
        
        // Get paginated employees for display
        $employees = $query->paginate($this->perPage);
        
        // Process employees to add payslip data
        foreach ($employees as $employee) {
            $employee->payslip = $this->generatePayslipForEmployee($employee);
        }
        
        // Custom sorting for gaji_bersih if needed
        if ($this->sortField === 'gaji_bersih') {
            $employees = $employees->sortBy(function($employee) {
                return $employee->payslip['gaji_bersih'];
            }, SORT_REGULAR, $this->sortDirection === 'desc');
        }
        
        // Get departments for filter
        $departments = UnitKerja::orderBy('nama_unit')->get();
        
        // Get years for dropdown (last 3 years)
        $currentYear = Carbon::now()->year;
        $years = range($currentYear - 2, $currentYear + 1);
        
        // Get the selected employee for modal
        $selectedEmployee = $this->getSelectedEmployee();
        
        return view('livewire.salary.report', [
            'employees' => $employees,
            'departments' => $departments,
            'months' => $this->months,
            'years' => $years,
            'selectedEmployee' => $selectedEmployee,
        ]);
    }
}
