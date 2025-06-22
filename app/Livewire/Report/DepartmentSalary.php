<?php

namespace App\Livewire\Report;

use Carbon\Carbon;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class DepartmentSalary extends Component
{
    use WithPagination;

    #[Layout('livewire.layouts.app-layout')]
    
    public $month;
    public $year;
    public $departmentId;
    public $searchTerm = '';
    public $sortField = 'nama';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $showDetailModal = false;
    public $selectedEmployee = null;
    public $payslip = null;
    public $totalSalaryData = [];
    public $departmentName = '';
    public $exportMode = 'pdf'; // 'pdf' or 'excel'
    
    public $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    
    protected $queryString = [
        'searchTerm' => ['except' => ''],
        'month' => ['except' => ''],
        'year' => ['except' => ''],
        'departmentId' => ['except' => ''],
        'sortField' => ['except' => 'nama'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function mount()
    {
        // Default to current month and year
        $this->month = $this->month ?: Carbon::now()->month;
        $this->year = $this->year ?: Carbon::now()->year;
        
        // Get manager's department if not specified
        if (!$this->departmentId) {
            $manager = Auth::user();
            $this->departmentId = $manager->unit_kerja_id;
            
            $department = UnitKerja::find($this->departmentId);
            $this->departmentName = $department ? $department->nama_unit : 'Unknown Department';
        } else {
            $department = UnitKerja::find($this->departmentId);
            $this->departmentName = $department ? $department->nama_unit : 'Unknown Department';
        }
        
        $this->calculateTotalSalary();
    }
    
    public function updatedMonth()
    {
        $this->calculateTotalSalary();
        $this->resetPage();
    }
    
    public function updatedYear()
    {
        $this->calculateTotalSalary();
        $this->resetPage();
    }
    
    public function updatedDepartmentId()
    {
        $department = UnitKerja::find($this->departmentId);
        $this->departmentName = $department ? $department->nama_unit : 'Unknown Department';
        $this->calculateTotalSalary();
        $this->resetPage();
    }
    
    public function updatedSearchTerm()
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
    }
    
    public function showEmployeePayslip($employeeId)
    {
        $this->selectedEmployee = Pegawai::with(['jabatan', 'unitKerja'])->find($employeeId);
        
        if (!$this->selectedEmployee) {
            $this->dispatch('swal:modal', [
                'title' => 'Error',
                'text' => 'Data pegawai tidak ditemukan.',
                'icon' => 'error'
            ]);
            return;
        }
        
        $this->generatePayslip();
        $this->showDetailModal = true;
    }
    
    private function generatePayslip()
    {
        if (!$this->selectedEmployee || !$this->selectedEmployee->jabatan) {
            return;
        }

        // Get base salary and allowances
        $gajiPokok = $this->selectedEmployee->gaji_pokok ?? 0;
        if ($gajiPokok == 0) {
            $gajiPokok = 4000000; // Default value if not set
        }

        $tunjangan = $this->selectedEmployee->jabatan->tunjangan ?? 0;
        if ($tunjangan == 0) {
            $tunjangan = 1000000; // Default value if not set
        }

        // Generate payslip date
        $payslipDate = Carbon::createFromDate($this->year, $this->month, 25);

        // Calculate deductions
        $bpjsKesehatan = $gajiPokok * 0.01;
        $bpjsKetenagakerjaan = $gajiPokok * 0.02;
        $pph21 = $this->calculatePPh21($gajiPokok, $tunjangan);
        
        // Calculate totals
        $totalEarnings = $gajiPokok + $tunjangan;
        $totalDeductions = $bpjsKesehatan + $bpjsKetenagakerjaan + $pph21;
        $netPay = $totalEarnings - $totalDeductions;
        
        $isPaid = $payslipDate->isPast() || $payslipDate->isToday();
        
        $this->payslip = [
            'id' => 'PS' . $this->year . str_pad($this->month, 2, '0', STR_PAD_LEFT) . str_pad($this->selectedEmployee->id ?? 0, 5, '0', STR_PAD_LEFT),
            'tanggal' => $payslipDate->format('Y-m-d'),
            'gaji_pokok' => $gajiPokok,
            'tunjangan_jabatan' => $tunjangan,
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
    
    private function calculateTotalSalary()
    {
        $employees = Pegawai::where('unit_kerja_id', $this->departmentId)
            ->with('jabatan')
            ->get();
            
        // Initialize counters
        $totalGross = 0;
        $totalDeductions = 0;
        $totalNet = 0;
        $employeeCount = $employees->count();
        
        foreach ($employees as $employee) {
            $gajiPokok = $employee->gaji_pokok ?? 4000000;
            $tunjangan = $employee->jabatan->tunjangan ?? 1000000;
            
            // Calculate deductions
            $bpjsKesehatan = $gajiPokok * 0.01;
            $bpjsKetenagakerjaan = $gajiPokok * 0.02;
            $pph21 = $this->calculatePPh21($gajiPokok, $tunjangan);
            
            // Calculate totals
            $totalGrossEmployee = $gajiPokok + $tunjangan;
            $totalDeductionsEmployee = $bpjsKesehatan + $bpjsKetenagakerjaan + $pph21;
            $netPayEmployee = $totalGrossEmployee - $totalDeductionsEmployee;
            
            $totalGross += $totalGrossEmployee;
            $totalDeductions += $totalDeductionsEmployee;
            $totalNet += $netPayEmployee;
        }
        
        $this->totalSalaryData = [
            'employee_count' => $employeeCount,
            'total_gross' => $totalGross,
            'total_deductions' => $totalDeductions,
            'total_net' => $totalNet,
            'average_salary' => $employeeCount > 0 ? $totalNet / $employeeCount : 0
        ];
    }
    
    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedEmployee = null;
        $this->payslip = null;
    }
    
    public function render()
    {
        // Get years for dropdown (last 3 years)
        $currentYear = Carbon::now()->year;
        $years = range($currentYear - 2, $currentYear);
        
        // Get departments for dropdown
        $departments = UnitKerja::all();
        
        // Get employee data for the selected department
        $employeeQuery = Pegawai::where('unit_kerja_id', $this->departmentId)
            ->with(['jabatan', 'unitKerja']);
            
        // Apply search filter
        if (!empty($this->searchTerm)) {
            $employeeQuery->where(function ($query) {
                $query->where('nama', 'like', '%'.$this->searchTerm.'%')
                      ->orWhere('nip', 'like', '%'.$this->searchTerm.'%');
            });
        }
        
        // Apply sorting
        $employees = $employeeQuery
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
        
        return view('livewire.report.department-salary', [
            'years' => $years,
            'departments' => $departments,
            'employees' => $employees
        ]);
    }
}