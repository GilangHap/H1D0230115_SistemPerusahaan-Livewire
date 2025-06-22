<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip {{ $employee->nama }} - {{ $monthName }} {{ $year }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #0d9488;
            font-size: 24px;
        }
        .header .company {
            font-size: 14px;
            margin: 5px 0;
        }
        .header .payslip-title {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }
        .employee-info {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #f9fafb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f1f5f9;
        }
        .earnings, .deductions {
            width: 48%;
        }
        .summary {
            margin-top: 20px;
            border-top: 2px solid #ddd;
            padding-top: 20px;
        }
        .summary-table {
            width: 50%;
            margin-left: auto;
        }
        .total-row {
            font-weight: bold;
            background-color: #e0f2f1;
        }
        .net-pay {
            font-weight: bold;
            font-size: 14px;
            color: #0d9488;
            background-color: #ccfbf1;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $company['name'] }}</h1>
            <div class="company">
                {{ $company['address'] }} | Tel: {{ $company['phone'] }} | {{ $company['email'] }}
            </div>
            <div class="payslip-title">SLIP GAJI - {{ strtoupper($monthName) }} {{ $year }}</div>
        </div>
        
        <div class="employee-info">
            <table style="border: none;">
                <tr>
                    <td style="border: none; width: 25%;"><strong>Nama</strong></td>
                    <td style="border: none; width: 25%;">: {{ $employee->nama }}</td>
                    <td style="border: none; width: 25%;"><strong>NIP</strong></td>
                    <td style="border: none; width: 25%;">: {{ $employee->nip }}</td>
                </tr>
                <tr>
                    <td style="border: none;"><strong>Jabatan</strong></td>
                    <td style="border: none;">: {{ $employee->jabatan->nama_jabatan }}</td>
                    <td style="border: none;"><strong>Unit</strong></td>
                    <td style="border: none;">: {{ $employee->unitKerja->nama_unit }}</td>
                </tr>
                <tr>
                    <td style="border: none;"><strong>Tanggal</strong></td>
                    <td style="border: none;">: {{ date('d M Y', strtotime($payslip['tanggal'])) }}</td>
                </tr>
            </table>
        </div>
        
        <table>
            <tr>
                <th colspan="2">PENDAPATAN</th>
                <th colspan="2">POTONGAN</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td style="text-align: right;">Rp {{ number_format($payslip['gaji_pokok'], 0, ',', '.') }}</td>
                <td>BPJS Kesehatan</td>
                <td style="text-align: right;">Rp {{ number_format($payslip['potongan']['bpjs_kesehatan'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan Jabatan</td>
                <td style="text-align: right;">Rp {{ number_format($payslip['tunjangan_jabatan'], 0, ',', '.') }}</td>
                <td>BPJS Ketenagakerjaan</td>
                <td style="text-align: right;">Rp {{ number_format($payslip['potongan']['bpjs_ketenagakerjaan'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>PPh 21</td>
                <td style="text-align: right;">Rp {{ number_format($payslip['potongan']['pph21'], 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Pendapatan</td>
                <td style="text-align: right;">Rp {{ number_format($payslip['total_pendapatan'], 0, ',', '.') }}</td>
                <td>Total Potongan</td>
                <td style="text-align: right;">Rp {{ number_format($payslip['total_potongan'], 0, ',', '.') }}</td>
            </tr>
        </table>
        
        <div class="summary">
            <table class="summary-table">
                <tr>
                    <th>Total Pendapatan</th>
                    <td style="text-align: right;">Rp {{ number_format($payslip['total_pendapatan'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Potongan</th>
                    <td style="text-align: right;">Rp {{ number_format($payslip['total_potongan'], 0, ',', '.') }}</td>
                </tr>
                <tr class="net-pay">
                    <th>GAJI BERSIH</th>
                    <td style="text-align: right;">Rp {{ number_format($payslip['gaji_bersih'], 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        
        <div class="footer">
            <p>Slip gaji ini dibuat secara otomatis dan tidak memerlukan tanda tangan. Untuk pertanyaan, harap hubungi Departemen HR.</p>
            <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }} | No. Referensi: {{ $payslip['id'] }}</p>
        </div>
    </div>
</body>
</html>