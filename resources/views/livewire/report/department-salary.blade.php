<div class="space-y-6">
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-purple-100 to-indigo-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-xl font-semibold text-slate-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Laporan Gaji Departemen
                </h1>
                <p class="text-slate-500 mt-1 pl-8">Manajemen laporan gaji untuk departemen <span class="font-medium text-purple-600">{{ $departmentName }}</span></p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="searchTerm" 
                        placeholder="Cari pegawai..." 
                        class="pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 text-sm w-full md:w-[260px]"
                    />
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Filter and Summary Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Filter Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 hover:shadow-md transition-shadow">
            <h3 class="font-medium text-slate-800 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter Laporan
            </h3>
            <div class="space-y-4">
                <div>
                    <label for="month" class="block text-sm font-medium text-slate-700 mb-1">Bulan</label>
                    <select 
                        id="month"
                        wire:model.live="month"
                        class="w-full rounded-lg border border-slate-200 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 text-sm py-2.5"
                    >
                        @foreach($months as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="year" class="block text-sm font-medium text-slate-700 mb-1">Tahun</label>
                    <select 
                        id="year"
                        wire:model.live="year"
                        class="w-full rounded-lg border border-slate-200 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 text-sm py-2.5"
                    >
                        @foreach($years as $yearOption)
                            <option value="{{ $yearOption }}">{{ $yearOption }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="lg:col-span-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <!-- Total Employees -->
                <div class="bg-gradient-to-br from-white to-slate-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex flex-col hover:shadow-md transition-shadow">
                    <div class="mb-1 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Total Pegawai</p>
                    <p class="text-2xl font-semibold text-slate-800 mt-1">{{ number_format($totalSalaryData['employee_count']) }}</p>
                    <div class="mt-2 text-xs text-slate-500">Departemen {{ $departmentName }}</div>
                </div>
                
                <!-- Total Gross Salary -->
                <div class="bg-gradient-to-br from-white to-slate-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex flex-col hover:shadow-md transition-shadow">
                    <div class="mb-1 text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Total Gaji Kotor</p>
                    <p class="text-2xl font-semibold text-slate-800 mt-1">Rp {{ number_format($totalSalaryData['total_gross']) }}</p>
                    <div class="mt-2 text-xs text-slate-500">Gaji + Tunjangan</div>
                </div>
                
                <!-- Total Deductions -->
                <div class="bg-gradient-to-br from-white to-slate-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex flex-col hover:shadow-md transition-shadow">
                    <div class="mb-1 text-rose-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Total Potongan</p>
                    <p class="text-2xl font-semibold text-slate-800 mt-1">Rp {{ number_format($totalSalaryData['total_deductions']) }}</p>
                    <div class="mt-2 text-xs text-slate-500">Pajak, BPJS, dll</div>
                </div>
                
                <!-- Total Net Pay -->
                <div class="bg-gradient-to-br from-white to-purple-50 rounded-xl shadow-sm border border-purple-100 p-5 flex flex-col hover:shadow-md transition-shadow">
                    <div class="mb-1 text-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Total Gaji Bersih</p>
                    <p class="text-2xl font-semibold text-purple-700 mt-1">Rp {{ number_format($totalSalaryData['total_net']) }}</p>
                    <div class="mt-2 text-xs text-slate-500">Dibayarkan ke pegawai</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Salary Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden hover:shadow-md transition-shadow">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-medium text-slate-800">Daftar Pegawai</h3>
            <div class="text-sm text-slate-500">
                Periode: <span class="font-medium text-purple-600">{{ $months[$month] }} {{ $year }}</span>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('nama')">
                                <div class="flex items-center space-x-1">
                                    <span>Pegawai</span>
                                    @if($sortField === 'nama')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            @if($sortDirection === 'asc')
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            @endif
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Jabatan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Gaji Pokok
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Tunjangan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Potongan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Gaji Bersih
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse($employees as $employee)
                            @php
                                $gajiPokok = $employee->gaji_pokok ?? 4000000;
                                $tunjangan = $employee->jabatan->tunjangan ?? 1000000;
                                
                                // Calculate deductions
                                $bpjsKesehatan = $gajiPokok * 0.01;
                                $bpjsKetenagakerjaan = $gajiPokok * 0.02;
                                $pph21 = $this->calculatePPh21($gajiPokok, $tunjangan);
                                
                                $totalDeductions = $bpjsKesehatan + $bpjsKetenagakerjaan + $pph21;
                                $netPay = ($gajiPokok + $tunjangan) - $totalDeductions;
                            @endphp
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img 
                                                src="{{ $employee->foto_profil ? Storage::url('profile-photos/' . $employee->foto_profil) : asset('images/default-avatar.svg') }}" 
                                                alt="{{ $employee->nama }}" 
                                                class="h-10 w-10 rounded-full object-cover border border-slate-200"
                                            >
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-slate-800">{{ $employee->nama }}</p>
                                            <div class="flex items-center">
                                                <p class="text-xs text-slate-500">{{ $employee->nip }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                        {{ $employee->jabatan ? $employee->jabatan->nama_jabatan : 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                    Rp {{ number_format($gajiPokok) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                    Rp {{ number_format($tunjangan) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                    Rp {{ number_format($totalDeductions) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-700">
                                    Rp {{ number_format($netPay) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button 
                                        wire:click="showEmployeePayslip({{ $employee->id }})"
                                        class="inline-flex items-center px-3 py-1 bg-purple-50 hover:bg-purple-100 text-purple-700 text-xs font-medium rounded-lg transition-colors"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Slip Gaji
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500 italic bg-slate-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                        </svg>
                                        <span>Tidak ada data pegawai ditemukan</span>
                                        @if(!empty($searchTerm))
                                            <span class="text-sm text-slate-400 mt-1">Coba ubah filter pencarian</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white border-t border-slate-200 px-4 py-3 sm:px-6">
            {{ $employees->links() }}
        </div>
    </div>

    <!-- Employee Payslip Detail Modal -->
    @if($showDetailModal && $selectedEmployee && $payslip)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeDetailModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="relative inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <!-- Modal Header with Purple Accent -->
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-4 text-white">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Slip Gaji Pegawai
                            </h3>
                            <button 
                                wire:click="closeDetailModal" 
                                class="text-white/80 hover:text-white transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Payslip Content -->
                    <div class="px-6 py-4">
                        <div class="flex flex-col md:flex-row justify-between items-center pb-4 mb-6 border-b border-slate-200">
                            <div class="flex items-center mb-4 md:mb-0">
                                <div class="flex-shrink-0 mr-4">
                                    <img 
                                        src="{{ $selectedEmployee->foto_profil ? Storage::url('profile-photos/' . $selectedEmployee->foto_profil) : asset('images/default-avatar.svg') }}" 
                                        alt="{{ $selectedEmployee->nama }}" 
                                        class="h-16 w-16 rounded-full object-cover border-2 border-purple-200"
                                    >
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800 text-lg">{{ $selectedEmployee->nama }}</h4>
                                    <p class="text-sm text-slate-500">{{ $selectedEmployee->nip }}</p>
                                    <div class="mt-1 flex items-center gap-2">
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                            {{ $selectedEmployee->jabatan ? $selectedEmployee->jabatan->nama_jabatan : 'N/A' }}
                                        </span>
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-700">
                                            {{ $selectedEmployee->unitKerja ? $selectedEmployee->unitKerja->nama_unit : 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center md:text-right">
                                <div class="inline-block px-4 py-2 rounded-lg bg-purple-50 border border-purple-100">
                                    <p class="text-xs text-purple-600">Periode Gaji</p>
                                    <p class="text-base font-medium text-purple-700">{{ $months[$month] }} {{ $year }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Income Section -->
                            <div class="bg-slate-50/50 rounded-lg p-4 border border-slate-100">
                                <h5 class="font-medium text-slate-800 mb-3 pb-2 border-b border-slate-200 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                    </svg>
                                    Pendapatan
                                </h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-slate-600">Gaji Pokok</p>
                                        <p class="text-sm font-medium text-slate-800">Rp {{ number_format($payslip['gaji_pokok']) }}</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-slate-600">Tunjangan Jabatan</p>
                                        <p class="text-sm font-medium text-slate-800">Rp {{ number_format($payslip['tunjangan_jabatan']) }}</p>
                                    </div>
                                    <div class="pt-2 mt-2 border-t border-slate-200">
                                        <div class="flex justify-between items-center font-medium">
                                            <p class="text-sm text-slate-700">Total Pendapatan</p>
                                            <p class="text-sm text-green-600">Rp {{ number_format($payslip['total_pendapatan']) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Deductions Section -->
                            <div class="bg-slate-50/50 rounded-lg p-4 border border-slate-100">
                                <h5 class="font-medium text-slate-800 mb-3 pb-2 border-b border-slate-200 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                    </svg>
                                    Potongan
                                </h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-slate-600">BPJS Kesehatan (1%)</p>
                                        <p class="text-sm font-medium text-slate-800">Rp {{ number_format($payslip['potongan']['bpjs_kesehatan']) }}</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-slate-600">BPJS Ketenagakerjaan (2%)</p>
                                        <p class="text-sm font-medium text-slate-800">Rp {{ number_format($payslip['potongan']['bpjs_ketenagakerjaan']) }}</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-slate-600">PPh 21</p>
                                        <p class="text-sm font-medium text-slate-800">Rp {{ number_format($payslip['potongan']['pph21']) }}</p>
                                    </div>
                                    <div class="pt-2 mt-2 border-t border-slate-200">
                                        <div class="flex justify-between items-center font-medium">
                                            <p class="text-sm text-slate-700">Total Potongan</p>
                                            <p class="text-sm text-rose-600">Rp {{ number_format($payslip['total_potongan']) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Net Pay Summary Box -->
                        <div class="mt-6 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg p-4 border border-purple-100 shadow-sm">
                            <div class="flex justify-between items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="text-center flex-grow">
                                    <p class="text-sm font-medium text-purple-600">Total Gaji Bersih</p>
                                    <p class="text-2xl font-bold text-purple-700 mt-1">Rp {{ number_format($payslip['gaji_bersih']) }}</p>
                                </div>
                                <div>
                                    <div class="w-11 h-11 rounded-full bg-white shadow-sm flex items-center justify-center border border-purple-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                        <button 
                            type="button" 
                            wire:click="closeDetailModal" 
                            class="w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:mt-0 sm:w-auto sm:text-sm"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- JavaScript for SweetAlert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('swal:modal', event => {
                Swal.fire({
                    title: event.detail[0].title,
                    text: event.detail[0].text,
                    icon: event.detail[0].icon,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#8b5cf6',
                });
            });
        });
    </script>
</div>