<div class="space-y-6">
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-teal-100 to-emerald-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-teal-100 to-cyan-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-xl font-semibold text-slate-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-teal-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                    Slip Gaji
                </h1>
                <p class="text-slate-500 mt-1 pl-8">Lihat dan unduh slip gaji bulanan Anda</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Month Selector -->
                <div class="relative">
                    <select wire:model.live="month" class="pl-10 pr-10 py-2 border border-slate-300 rounded-lg text-slate-800 text-sm focus:border-teal-500 focus:ring-teal-500">
                        @foreach($months as $key => $monthName)
                            <option value="{{ $key }}">{{ $monthName }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                
                <!-- Year Selector -->
                <div class="relative">
                    <select wire:model.live="year" class="pl-10 pr-10 py-2 border border-slate-300 rounded-lg text-slate-800 text-sm focus:border-teal-500 focus:ring-teal-500">
                        @foreach($years as $yearOption)
                            <option value="{{ $yearOption }}">{{ $yearOption }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if($payslip)
        <!-- Payslip Overview -->
        <div class="bg-gradient-to-br from-teal-500 to-emerald-600 rounded-xl shadow-lg overflow-hidden text-white">
            <div class="px-6 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-white">
                            {{ $employee->nama }}
                        </h2>
                        <p class="text-teal-100 text-sm">
                            {{ $employee->jabatan->nama_jabatan }} | {{ $employee->unitKerja->nama_unit }}
                        </p>
                        <p class="text-teal-50 text-xs mt-1">NIP: {{ $employee->nip }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-teal-100 text-sm">Periode</div>
                        <div class="font-bold">{{ $months[$month] }} {{ $year }}</div>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-teal-700/30 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-teal-100 text-sm">Total Gaji Bersih</span>
                        <h3 class="text-2xl font-bold">Rp {{ number_format($payslip['gaji_bersih'], 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex gap-2">
                        @if($payslip['status'] === 'paid')
                            <span class="px-3 py-1 bg-teal-200 text-teal-800 text-xs font-semibold rounded-full inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Dibayarkan
                            </span>
                        @else
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                Menunggu Pembayaran
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <div class="text-teal-100">Tanggal</div>
                        <div class="font-semibold">{{ \Carbon\Carbon::parse($payslip['tanggal'])->format('d M Y') }}</div>
                    </div>
                    <div class="text-sm">
                        <div class="text-teal-100">Metode Pembayaran</div>
                        <div class="font-semibold">{{ $payslip['payment_method'] }}</div>
                    </div>
                    <div class="text-sm">
                        <div class="text-teal-100">Rekening</div>
                        <div class="font-semibold">{{ $payslip['account_number'] }}</div>
                    </div>
                    <div class="text-sm">
                        <div class="text-teal-100">Nomor Referensi</div>
                        <div class="font-semibold">{{ $payslip['id'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Earnings Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="px-6 py-4 bg-teal-50 border-b border-slate-200/60 flex items-center justify-between">
                    <h3 class="text-slate-800 font-semibold flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                        Pendapatan
                    </h3>
                    <span class="text-lg font-bold text-teal-600">Rp {{ number_format($payslip['total_pendapatan'], 0, ',', '.') }}</span>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        <li class="flex justify-between items-center">
                            <div class="flex items-start">
                                <span class="w-2 h-2 mt-1.5 rounded-full bg-teal-400 mr-2"></span>
                                <div>
                                    <p class="text-sm font-medium text-slate-800">Gaji Pokok</p>
                                    <p class="text-xs text-slate-500">Gaji pokok bulanan</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($payslip['gaji_pokok'], 0, ',', '.') }}</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <div class="flex items-start">
                                <span class="w-2 h-2 mt-1.5 rounded-full bg-emerald-400 mr-2"></span>
                                <div>
                                    <p class="text-sm font-medium text-slate-800">Tunjangan Jabatan</p>
                                    <p class="text-xs text-slate-500">Tunjangan sesuai jabatan</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($payslip['tunjangan_jabatan'], 0, ',', '.') }}</span>
                        </li>
                        
                        <li class="pt-3 border-t border-slate-200 flex justify-between items-center">
                            <span class="font-medium text-slate-800">Total Pendapatan</span>
                            <span class="font-bold text-teal-600">Rp {{ number_format($payslip['total_pendapatan'], 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Deductions Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="px-6 py-4 bg-rose-50 border-b border-slate-200/60 flex items-center justify-between">
                    <h3 class="text-slate-800 font-semibold flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        Potongan
                    </h3>
                    <span class="text-lg font-bold text-rose-600">Rp {{ number_format($payslip['total_potongan'], 0, ',', '.') }}</span>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        <li class="flex justify-between items-center">
                            <div class="flex items-start">
                                <span class="w-2 h-2 mt-1.5 rounded-full bg-rose-400 mr-2"></span>
                                <div>
                                    <p class="text-sm font-medium text-slate-800">BPJS Kesehatan</p>
                                    <p class="text-xs text-slate-500">Iuran BPJS Kesehatan</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($payslip['potongan']['bpjs_kesehatan'], 0, ',', '.') }}</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <div class="flex items-start">
                                <span class="w-2 h-2 mt-1.5 rounded-full bg-pink-400 mr-2"></span>
                                <div>
                                    <p class="text-sm font-medium text-slate-800">BPJS Ketenagakerjaan</p>
                                    <p class="text-xs text-slate-500">Iuran BPJS Ketenagakerjaan</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($payslip['potongan']['bpjs_ketenagakerjaan'], 0, ',', '.') }}</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <div class="flex items-start">
                                <span class="w-2 h-2 mt-1.5 rounded-full bg-red-400 mr-2"></span>
                                <div>
                                    <p class="text-sm font-medium text-slate-800">PPh 21</p>
                                    <p class="text-xs text-slate-500">Pajak penghasilan</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($payslip['potongan']['pph21'], 0, ',', '.') }}</span>
                        </li>
                        <li class="pt-3 border-t border-slate-200 flex justify-between items-center">
                            <span class="font-medium text-slate-800">Total Potongan</span>
                            <span class="font-bold text-rose-600">Rp {{ number_format($payslip['total_potongan'], 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Salary Summary -->
        <div class="bg-slate-50 rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200/60">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                    </svg>
                    Ringkasan Gaji
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-slate-200/60">
                        <div class="text-sm text-slate-500">Total Pendapatan</div>
                        <div class="text-2xl font-bold text-slate-800 mt-1">Rp {{ number_format($payslip['total_pendapatan'], 0, ',', '.') }}</div>
                        <div class="flex items-center mt-2 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-teal-700">Gaji pokok dan tunjangan</span>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-slate-200/60">
                        <div class="text-sm text-slate-500">Total Potongan</div>
                        <div class="text-2xl font-bold text-slate-800 mt-1">Rp {{ number_format($payslip['total_potongan'], 0, ',', '.') }}</div>
                        <div class="flex items-center mt-2 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16 7a1 1 0 11-2 0V5a1 1 0 11-2 0v2H9V5a1 1 0 11-2 0v2H5a1 1 0 110 2h2v6H5a1 1 0 110-2h2a1 1 0 011 1v2a1 1 0 102 0v-2h3v2a1 1 0 102 0v-2h3a1 1 0 010 2h-3V9h3a1 1 0 000-2h-3z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-rose-700">Pajak dan iuran wajib</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-5 rounded-lg shadow-md">
                        <div class="text-sm text-teal-50">Gaji Bersih</div>
                        <div class="text-2xl font-bold text-white mt-1">Rp {{ number_format($payslip['gaji_bersih'], 0, ',', '.') }}</div>
                        <div class="flex items-center mt-2 text-xs text-teal-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                            </svg>
                            <span>Jumlah yang diterima</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex flex-wrap gap-3 justify-center">
                    <button 
                        wire:click="downloadPdf"
                        class="py-2.5 px-5 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors flex items-center shadow-sm"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                        </svg>
                        Unduh PDF
                    </button>
                </div>
            </div>
        </div>
        
    @else
        <!-- No Payslip Available -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-10 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-slate-100 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-800 mb-2">Slip Gaji Tidak Ditemukan</h3>
                <p class="text-slate-500 max-w-md mb-6">Slip gaji untuk bulan {{ $months[$month] }} {{ $year }} belum tersedia. Silakan pilih bulan atau tahun lain, atau hubungi departemen HR untuk informasi lebih lanjut.</p>
                <div class="flex flex-wrap gap-3 justify-center">
                    <button class="py-2 px-4 bg-teal-50 hover:bg-teal-100 text-teal-600 rounded-lg transition-colors text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Hubungi HR
                    </button>
                    <button class="py-2 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-colors text-sm font-medium flex items-center" onclick="window.history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
