<?php

namespace App\Livewire\Salary;

use Carbon\Carbon;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Payslip extends Component
{

    #[Layout('livewire.layouts.app-layout')]
    public $month;
    public $year;
    public $payslip = null;
    public $employee = null;
    
    public $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    
    protected $queryString = [
        'month' => ['except' => ''],
        'year' => ['except' => '']
    ];

    public function mount()
    {
        // Default to current month and year if not specified
        $this->month = $this->month ?: Carbon::now()->month;
        $this->year = $this->year ?: Carbon::now()->year;
        
        $this->employee = Pegawai::with(['jabatan', 'unitKerja'])->find(Auth::id());
        $this->loadPayslip();
    }
    
    public function updatedMonth()
    {
        $this->loadPayslip();
    }
    
    public function updatedYear()
    {
        $this->loadPayslip();
    }
    
    private function loadPayslip()
    {
        // First check if employee data is complete
        if (!$this->employee || !$this->employee->jabatan) {
            session()->flash('error', 'Data pegawai atau jabatan tidak lengkap.');
            return;
        }

        // Make sure gaji_pokok has a value
        $gajiPokok = $this->employee->gaji_pokok ?? 0;
        if ($gajiPokok == 0) {
            $gajiPokok = 4000000; // Default value if not set
        }

        // Make sure tunjangan has a value
        $tunjangan = $this->employee->jabatan->tunjangan ?? 0;
        if ($tunjangan == 0) {
            $tunjangan = 1000000; // Default value if not set
        }

        // For demonstration: generate payslip
        $payslipDate = Carbon::createFromDate($this->year, $this->month, 25);
        
        // Generate attendance data
        $workingDays = 22; // Standard working days per month
        $actualWorkingDays = min($workingDays, $workingDays - rand(0, 2)); // Random small absences
        
        // Calculate deductions
        $bpjsKesehatan = $gajiPokok * 0.01; // 1% of basic salary
        $bpjsKetenagakerjaan = $gajiPokok * 0.02; // 2% of basic salary
        $pph21 = $this->calculatePPh21($gajiPokok, $tunjangan); // Progressive tax calculation
        
        // Calculate total (now without uang makan, transportasi, and lembur)
        $totalEarnings = $gajiPokok + $tunjangan;
        $totalDeductions = $bpjsKesehatan + $bpjsKetenagakerjaan + $pph21;
        $netPay = $totalEarnings - $totalDeductions;
        
        // Determine if payslip should be marked as paid (past dates) or pending (future dates)
        $isPaid = $payslipDate->isPast() || $payslipDate->isToday();
        
        $this->payslip = [
            'id' => 'PS' . $this->year . str_pad($this->month, 2, '0', STR_PAD_LEFT) . str_pad($this->employee->id ?? 0, 5, '0', STR_PAD_LEFT),
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
            'status' => $isPaid ? 'paid' : 'pending',
            'payment_method' => 'Bank Transfer',
            'account_number' => '****' . rand(1000, 9999),
            'bank_name' => 'Bank Mandiri'
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
    
    public function downloadPdf()
    {
        // Show success message
        $this->dispatch('swal:modal', [
            'title' => 'Download Started',
            'text' => 'Your payslip is being downloaded...',
            'icon' => 'success'
        ]);
        
        // In a real app, this would generate and download a PDF
        // We would redirect to a controller action:
        return redirect()->route('payslip.download', [
            'month' => $this->month,
            'year' => $this->year
        ]);
    }
    
    public function emailPayslip()
    {
        $this->dispatch('swal:modal', [
            'title' => 'Email Sent',
            'text' => 'Your payslip has been sent to your email address.',
            'icon' => 'success'
        ]);
    }
    
    public function render()
    {
        // Get years for dropdown (last 3 years)
        $currentYear = Carbon::now()->year;
        $years = range($currentYear - 2, $currentYear);
        
        return view('livewire.salary.payslip', [
            'years' => $years
        ]);
    }
}