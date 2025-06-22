<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;

class PayslipController extends Controller
{
    public function download(Request $request, $year, $month)
    {
        // Verify the user has access to this payslip
        $employee = Pegawai::with(['jabatan', 'unitKerja'])->find(Auth::id());
        
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee information not found');
        }
        
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        // Generate payslip data
        $payslipDate = Carbon::createFromDate($year, $month, 25);
        
        // Basic pay from employee record
        $gajiPokok = $employee->gaji_pokok ?? 0;
        $tunjangan = $employee->jabatan->tunjangan ?? 0;
        
        // Generate simple payslip data
        $payslip = $this->generatePayslipData($employee, $payslipDate);
        
        // Generate PDF
        $pdf = PDF::loadView('pdf.payslip', [
            'payslip' => $payslip,
            'employee' => $employee,
            'monthName' => $months[$month],
            'year' => $year,
            'company' => [
                'name' => 'PT. Jenderal Soedirman',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'phone' => '021-12345678',
                'email' => 'hr@soederman.jenderal.com',
                'website' => 'www.jenderalsoederman.com'
            ]
        ]);
        
        // Download the PDF
        return $pdf->download('payslip-' . $employee->nip . '-' . $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '.pdf');
    }
    
    private function generatePayslipData($employee, $payslipDate)
    {
        // Get employee data
        $gajiPokok = $employee->gaji_pokok ?? 0;
        $tunjangan = $employee->jabatan->tunjangan ?? 0;
        
        // Mock attendance data (in a real app, get from attendance records)
        $workingDays = 22;
        $actualWorkingDays = $workingDays;
        
        // Calculate deductions
        $bpjsKesehatan = $gajiPokok * 0.01;
        $bpjsKetenagakerjaan = $gajiPokok * 0.02;
        $pph21 = $this->calculatePPh21($gajiPokok, $tunjangan);
        
        // Calculate totals
        $totalEarnings = $gajiPokok + $tunjangan  ;
        $totalDeductions = $bpjsKesehatan + $bpjsKetenagakerjaan + $pph21;
        $netPay = $totalEarnings - $totalDeductions;
        
        // Return payslip data
        return [
            'id' => 'PS' . $payslipDate->format('Ym') . str_pad($employee->id, 5, '0', STR_PAD_LEFT),
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
            'status' => 'paid',
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
}
