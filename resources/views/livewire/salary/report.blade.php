<!-- filepath: d:\laragon\www\Sistem-Perusahaan\resources\views\livewire\salary\report.blade.php -->
<div class="space-y-6">
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-gradient-to-br from-white to-purple-50 rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-purple-100 to-indigo-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Laporan Gaji Karyawan</h1>
                <p class="mt-1 text-slate-600">
                    Periode: 
                    <span class="font-medium">{{ $months[$month] ?? '' }}</span> 
                    <span class="font-medium">{{ $year ?? '' }}</span>
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <button 
                    wire:click="exportToExcel"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-green-50 border border-green-200 text-green-700 rounded-lg hover:bg-green-100 transition"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-70 cursor-wait"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-sm font-medium">Excel</span>
                </button>
                
                <button 
                    wire:click="exportToPdf"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 border border-red-200 text-red-700 rounded-lg hover:bg-red-100 transition"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-70 cursor-wait"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm font-medium">PDF</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Section (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Total Salary -->
        <div class="bg-gradient-to-br from-white to-indigo-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute bottom-0 right-0 w-20 h-20 -mb-6 -mr-6 rounded-full bg-gradient-to-br from-indigo-200/40 to-indigo-300/40 transform rotate-45 blur-sm group-hover:rotate-90 transition-transform duration-500"></div>
            <div class="w-12 h-12 rounded-lg bg-indigo-500 flex items-center justify-center mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-indigo-900">Total Gaji</h3>
                <div class="text-2xl font-bold text-indigo-900">Rp {{ number_format($totalSalary, 0, ',', '.') }}</div>
                <p class="text-xs text-indigo-500 mt-1">{{ $months[$month] ?? '' }} {{ $year ?? '' }}</p>
            </div>
        </div>
        
        <!-- Average Salary -->
        <div class="bg-gradient-to-br from-white to-purple-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute bottom-0 right-0 w-20 h-20 -mb-6 -mr-6 rounded-full bg-gradient-to-br from-purple-200/40 to-purple-300/40 transform rotate-45 blur-sm group-hover:rotate-90 transition-transform duration-500"></div>
            <div class="w-12 h-12 rounded-lg bg-purple-500 flex items-center justify-center mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-purple-900">Rata-rata Gaji</h3>
                <div class="text-2xl font-bold text-purple-900">Rp {{ number_format($averageSalary, 0, ',', '.') }}</div>
                <p class="text-xs text-purple-500 mt-1">Per karyawan</p>
            </div>
        </div>
        
        <!-- Total Employees -->
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute bottom-0 right-0 w-20 h-20 -mb-6 -mr-6 rounded-full bg-gradient-to-br from-blue-200/40 to-blue-300/40 transform rotate-45 blur-sm group-hover:rotate-90 transition-transform duration-500"></div>
            <div class="w-12 h-12 rounded-lg bg-blue-500 flex items-center justify-center mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-blue-900">Jumlah Karyawan</h3>
                <div class="text-2xl font-bold text-blue-900">{{ number_format($totalEmployees) }}</div>
                <p class="text-xs text-blue-500 mt-1">Aktif dengan gaji</p>
            </div>
        </div>
    </div>

    <!-- Department Salary Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
        <h3 class="text-base font-semibold text-slate-800 mb-4">Distribusi Gaji per Departemen</h3>
        <div class="h-80">
            <canvas id="departmentChart"></canvas>
        </div>
    </div>
    
    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="sr-only">Cari</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500" placeholder="Cari nama karyawan...">
                </div>
            </div>
            
            <!-- Department Filter -->
            <div>
                <label for="departmentFilter" class="sr-only">Departemen</label>
                <select wire:model.live="departmentFilter" id="departmentFilter" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                    <option value="">Semua Departemen</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->nama_unit }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Month Filter -->
            <div>
                <label for="month" class="sr-only">Bulan</label>
                <select wire:model.live="month" id="month" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                    @foreach($months as $key => $monthName)
                        <option value="{{ $key }}">{{ $monthName }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Year Filter -->
            <div>
                <label for="year" class="sr-only">Tahun</label>
                <select wire:model.live="year" id="year" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                    @foreach($years as $yearOption)
                        <option value="{{ $yearOption }}">{{ $yearOption }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Reset Button -->
            <div class="col-span-full flex justify-end">
                <button wire:click="resetFilters" class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium text-slate-500 bg-slate-100 border border-slate-200 rounded-lg hover:bg-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Reset Filter</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Salary List -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('nama')">
                                Karyawan
                                @if($sortField === 'nama')
                                    @if($sortDirection === 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Jabatan & Departemen
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Gaji Pokok
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Tunjangan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Total Potongan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('gaji_bersih')">
                                Gaji Bersih
                                @if($sortField === 'gaji_bersih')
                                    @if($sortDirection === 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse ($employees as $employee)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-9 w-9">
                                        @if($employee->foto_profil)
                                            <img class="h-9 w-9 rounded-full object-cover" src="{{ asset('storage/profile-photos/'.$employee->foto_profil) }}" alt="">
                                        @else
                                            <div class="h-9 w-9 rounded-full bg-purple-500 flex items-center justify-center text-white font-medium text-sm">
                                                {{ substr($employee->nama ?? 'U', 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-slate-800">
                                            {{ $employee->nama }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            {{ $employee->nip }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-800">
                                    {{ $employee->jabatan ? $employee->jabatan->nama_jabatan : 'Belum diatur' }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    {{ $employee->unitKerja ? $employee->unitKerja->nama_unit : 'Belum diatur' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-800">
                                    Rp {{ number_format($employee->payslip['gaji_pokok'], 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-800">
                                    Rp {{ number_format($employee->payslip['tunjangan_jabatan'], 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-red-700">
                                    - Rp {{ number_format($employee->payslip['total_potongan'], 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-emerald-600">
                                    Rp {{ number_format($employee->payslip['gaji_bersih'], 0, ',', '.') }}
                                </div>
                            </td>
                            <!-- Tombol detail di baris tabel -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button 
                                    wire:click="openDetailModal({{ $employee->id }})" 
                                    class="text-indigo-600 hover:text-indigo-900 mr-3"
                                >
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-slate-500 font-medium mb-1">Tidak ada data gaji</p>
                                    <p class="text-slate-400 text-sm">Tidak ditemukan data gaji yang sesuai filter</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($employees->hasPages())
            <div class="border-t border-slate-200 px-6 py-3">
                {{ $employees->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Detail Gaji -->
    @if($showDetailModal && $selectedEmployee)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeDetailModal"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <!-- Modal header -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-slate-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Detail Gaji Karyawan
                        </h3>
                        <button wire:click="closeDetailModal" class="text-slate-400 hover:text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Modal content unchanged -->
                    <div class="px-6 py-4">
                        <!-- Employee Info -->
                        <div class="flex items-start mb-6">
                            <div class="flex-shrink-0 h-16 w-16">
                                @if($selectedEmployee->foto_profil)
                                    <img class="h-16 w-16 rounded-full object-cover" src="{{ asset('storage/profile-photos/'.$selectedEmployee->foto_profil) }}" alt="">
                                @else
                                    <div class="h-16 w-16 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 flex items-center justify-center text-white font-bold text-xl">
                                        {{ substr($selectedEmployee->nama, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-lg font-semibold text-slate-800">{{ $selectedEmployee->nama }}</h4>
                                <p class="text-sm text-slate-500">{{ $selectedEmployee->nip }}</p>
                                <div class="mt-1 flex items-center">
                                    <span class="text-sm text-slate-600">
                                        {{ $selectedEmployee->jabatan ? $selectedEmployee->jabatan->nama_jabatan : 'Belum diatur' }}
                                    </span>
                                    <span class="mx-2 text-slate-300">|</span>
                                    <span class="text-sm text-slate-600">
                                        {{ $selectedEmployee->unitKerja ? $selectedEmployee->unitKerja->nama_unit : 'Belum diatur' }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-slate-500">Periode Gaji</div>
                                <div class="text-sm font-medium text-slate-800">
                                    {{ $months[$month] }} {{ $year }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Divider -->
                        <div class="border-t border-slate-200 my-4"></div>
                        
                        <!-- Salary Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column: Earnings -->
                            <div>
                                <h5 class="text-sm font-semibold text-slate-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Pendapatan
                                </h5>
                                
                                <div class="bg-slate-50 rounded-lg p-4 space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">Gaji Pokok</span>
                                        <span class="text-sm font-medium text-slate-800">
                                            Rp {{ number_format($selectedEmployee->payslip['gaji_pokok'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">Tunjangan Jabatan</span>
                                        <span class="text-sm font-medium text-slate-800">
                                            Rp {{ number_format($selectedEmployee->payslip['tunjangan_jabatan'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <!-- Divider -->
                                    <div class="border-t border-slate-200 my-2"></div>
                                    
                                    <!-- Total Earnings -->
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-slate-700">Total Pendapatan</span>
                                        <span class="text-sm font-semibold text-emerald-600">
                                            Rp {{ number_format($selectedEmployee->payslip['total_pendapatan']) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column: Deductions -->
                            <div>
                                <h5 class="text-sm font-semibold text-slate-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                    </svg>
                                    Potongan
                                </h5>
                                
                                <div class="bg-slate-50 rounded-lg p-4 space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">BPJS Kesehatan (1%)</span>
                                        <span class="text-sm font-medium text-slate-800">
                                            Rp {{ number_format($selectedEmployee->payslip['potongan']['bpjs_kesehatan'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">BPJS Ketenagakerjaan (2%)</span>
                                        <span class="text-sm font-medium text-slate-800">
                                            Rp {{ number_format($selectedEmployee->payslip['potongan']['bpjs_ketenagakerjaan'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">PPh 21</span>
                                        <span class="text-sm font-medium text-slate-800">
                                            Rp {{ number_format($selectedEmployee->payslip['potongan']['pph21'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <!-- Divider -->
                                    <div class="border-t border-slate-200 my-2"></div>
                                    
                                    <!-- Total Deductions -->
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-slate-700">Total Potongan</span>
                                        <span class="text-sm font-semibold text-rose-600">
                                            Rp {{ number_format($selectedEmployee->payslip['total_potongan'] ) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Net Pay Summary -->
                        <div class="mt-6 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h5 class="text-base font-semibold text-slate-800">Gaji Bersih</h5>
                                    <p class="text-xs text-slate-500 mt-1">Pendapatan - Potongan</p>
                                </div>
                                <div class="text-xl font-bold text-indigo-600">
                                    Rp {{ number_format($selectedEmployee->payslip['gaji_bersih'], 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="bg-slate-50 px-6 py-3 flex justify-end border-t border-slate-200">
                        <button wire:click="closeDetailModal" class="mr-3 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md shadow-sm hover:bg-slate-50 focus:outline-none">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- JavaScript for SweetAlert and Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            // Initialize charts when the component is loaded
            initCharts();
            
            // Re-initialize charts when Livewire updates
            Livewire.hook('morph.updated', () => {
                initCharts();
            });
            
            // SweetAlert for notifications
            Livewire.on('swal:modal', param => {
                Swal.fire({
                    icon: param.icon || 'info',
                    title: param.title || '',
                    text: param.text || '',
                    showConfirmButton: true
                });
            });
        });
        
        function initCharts() {
            // Department Chart
            initDepartmentChart();
        }
        
        function initDepartmentChart() {
            const departmentCtx = document.getElementById('departmentChart');
            
            if (departmentCtx) {
                // Get stats from Livewire component
                const departmentStats = @json($departmentStats);
                const labels = [];
                const employeeData = [];
                const salaryData = [];
                
                // Extract data from departmentStats
                Object.values(departmentStats).forEach((dept) => {
                    if (dept.count > 0) {
                        labels.push(dept.name);
                        employeeData.push(dept.count);
                        salaryData.push(dept.total);
                    }
                });
                
                if (window.departmentChart instanceof Chart) {
                    window.departmentChart.destroy();
                }
                
                // Format currency for tooltips
                const currencyFormatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
                
                window.departmentChart = new Chart(departmentCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Total Gaji',
                                data: salaryData,
                                backgroundColor: 'rgba(79, 70, 229, 0.8)',
                                borderColor: 'rgba(79, 70, 229, 1)',
                                borderWidth: 1,
                                yAxisID: 'y',
                                barThickness: 20,
                            },
                            {
                                label: 'Jumlah Karyawan',
                                data: employeeData,
                                backgroundColor: 'rgba(168, 85, 247, 0.6)',
                                borderColor: 'rgba(168, 85, 247, 1)',
                                borderWidth: 1,
                                yAxisID: 'y1',
                                barThickness: 20,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        scales: {
                            y: {
                                type: 'linear',
                                position: 'left',
                                title: {
                                    display: true,
                                    text: 'Total Gaji (Rp)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return currencyFormatter.format(value).replace('IDR', 'Rp');
                                    }
                                }
                            },
                            y1: {
                                type: 'linear',
                                position: 'right',
                                title: {
                                    display: true,
                                    text: 'Jumlah Karyawan'
                                },
                                grid: {
                                    drawOnChartArea: false,
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.datasetIndex === 0) {
                                            label += currencyFormatter.format(context.parsed.y).replace('IDR', 'Rp');
                                        } else {
                                            label += context.parsed.y + ' karyawan';
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        }
    </script>
    
    <!-- Alpine.js for Tooltips -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</div>
