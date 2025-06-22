<div class="space-y-6">
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-gradient-to-br from-white to-emerald-50 rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-emerald-100 to-teal-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Laporan Cuti Karyawan</h1>
                <p class="mt-1 text-slate-600">
                    Periode: 
                    <span class="font-medium">{{ \Carbon\Carbon::parse($customDateStart)->format('d M Y') }}</span> 
                    hingga 
                    <span class="font-medium">{{ \Carbon\Carbon::parse($customDateEnd)->format('d M Y') }}</span>
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <button 
                    wire:click="exportToExcel"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg hover:bg-emerald-100 transition"
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
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg hover:bg-rose-100 transition"
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Cuti -->
        <div class="bg-gradient-to-br from-white to-indigo-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute bottom-0 right-0 w-20 h-20 -mb-6 -mr-6 rounded-full bg-gradient-to-br from-indigo-200/40 to-indigo-300/40 transform rotate-45 blur-sm group-hover:rotate-90 transition-transform duration-500"></div>
            <div class="w-12 h-12 rounded-lg bg-indigo-500 flex items-center justify-center mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-indigo-900">Total Cuti</h3>
                <div class="text-2xl font-bold text-indigo-900">{{ number_format($totalLeaves) }}</div>
                <p class="text-xs text-indigo-500 mt-1">Periode yang dipilih</p>
            </div>
        </div>
        
        <!-- Total Hari Cuti -->
        <div class="bg-gradient-to-br from-white to-emerald-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute bottom-0 right-0 w-20 h-20 -mb-6 -mr-6 rounded-full bg-gradient-to-br from-emerald-200/40 to-emerald-300/40 transform rotate-45 blur-sm group-hover:rotate-90 transition-transform duration-500"></div>
            <div class="w-12 h-12 rounded-lg bg-emerald-500 flex items-center justify-center mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-emerald-900">Total Hari</h3>
                <div class="text-2xl font-bold text-emerald-900">{{ number_format($totalDays) }}</div>
                <p class="text-xs text-emerald-500 mt-1">Hari cuti diambil</p>
            </div>
        </div>
        
        <!-- Rata-rata Hari/Cuti -->
        <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute bottom-0 right-0 w-20 h-20 -mb-6 -mr-6 rounded-full bg-gradient-to-br from-amber-200/40 to-amber-300/40 transform rotate-45 blur-sm group-hover:rotate-90 transition-transform duration-500"></div>
            <div class="w-12 h-12 rounded-lg bg-amber-500 flex items-center justify-center mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-amber-900">Rata-rata</h3>
                <div class="text-2xl font-bold text-amber-900">
                    {{ $totalLeaves > 0 ? number_format($totalDays / $totalLeaves, 1) : 0 }}
                </div>
                <p class="text-xs text-amber-500 mt-1">Hari per pengajuan</p>
            </div>
        </div>
        
        <!-- Total Karyawan -->
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute bottom-0 right-0 w-20 h-20 -mb-6 -mr-6 rounded-full bg-gradient-to-br from-blue-200/40 to-blue-300/40 transform rotate-45 blur-sm group-hover:rotate-90 transition-transform duration-500"></div>
            <div class="w-12 h-12 rounded-lg bg-blue-500 flex items-center justify-center mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-blue-900">Karyawan</h3>
                <div class="text-2xl font-bold text-blue-900">{{ number_format($totalEmployees) }}</div>
                <p class="text-xs text-blue-500 mt-1">Mengajukan cuti</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Monthly Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
            <h3 class="text-base font-semibold text-slate-800 mb-4">Distribusi Cuti Bulanan</h3>
            <div class="h-64">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
        
        <!-- Department Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
            <h3 class="text-base font-semibold text-slate-800 mb-4">Distribusi Cuti per Departemen</h3>
            <div class="h-64">
                <canvas id="departmentChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="sr-only">Cari</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="Cari nama karyawan...">
                </div>
            </div>
            
            <!-- Status Filter -->
            <div>
                <label for="statusFilter" class="sr-only">Status</label>
                <select wire:model.live="statusFilter" id="statusFilter" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Semua Status</option>
                    <option value="approved">Disetujui</option>
                    <option value="pending">Menunggu</option>
                    <option value="rejected">Ditolak</option>
                    <option value="canceled">Dibatalkan</option>
                </select>
            </div>
            
            <!-- Department Filter -->
            <div>
                <label for="departmentFilter" class="sr-only">Departemen</label>
                <select wire:model.live="departmentFilter" id="departmentFilter" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Semua Departemen</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->nama_unit }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Date Range -->
            <div>
                <label for="dateRange" class="sr-only">Periode</label>
                <select wire:model.live="dateRange" id="dateRange" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="today">Hari Ini</option>
                    <option value="thisWeek">Minggu Ini</option>
                    <option value="thisMonth">Bulan Ini</option>
                    <option value="lastMonth">Bulan Lalu</option>
                    <option value="thisYear">Tahun Ini</option>
                    <option value="custom">Custom</option>
                </select>
            </div>
            
            <!-- Custom Date Range (shown when dateRange is custom) -->
            <div class="flex gap-2 {{ $dateRange === 'custom' ? '' : 'hidden' }}">
                <div class="w-1/2">
                    <label for="customDateStart" class="sr-only">Tanggal Mulai</label>
                    <input type="date" wire:model.live="customDateStart" id="customDateStart" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div class="w-1/2">
                    <label for="customDateEnd" class="sr-only">Tanggal Akhir</label>
                    <input type="date" wire:model.live="customDateEnd" id="customDateEnd" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>
        </div>
        
        <!-- Month/Year Filter (Alternative to Date Range) -->
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Month Filter -->
            <div>
                <label for="monthFilter" class="sr-only">Bulan</label>
                <select wire:model.live="monthFilter" id="monthFilter" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Semua Bulan</option>
                    @foreach($months as $key => $month)
                        <option value="{{ $key }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Year Filter -->
            <div>
                <label for="yearFilter" class="sr-only">Tahun</label>
                <select wire:model.live="yearFilter" id="yearFilter" class="block w-full py-2 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Reset Button -->
            <div class="lg:col-span-3 flex justify-end">
                <button wire:click="resetFilters" class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium text-slate-500 bg-slate-100 border border-slate-200 rounded-lg hover:bg-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Reset Filter</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Leave List -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('tanggal_mulai')">
                                Periode Cuti
                                @if($sortField === 'tanggal_mulai')
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
                            Karyawan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('jumlah_hari')">
                                Hari
                                @if($sortField === 'jumlah_hari')
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
                            Departemen
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Alasan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Disetujui Oleh
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse ($leaves as $leave)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-800">
                                    {{ \Carbon\Carbon::parse($leave->tanggal_mulai)->format('d M Y') }}
                                </div>
                                @if($leave->tanggal_mulai != $leave->tanggal_akhir)
                                    <div class="text-xs text-slate-500">
                                        s/d {{ \Carbon\Carbon::parse($leave->tanggal_akhir)->format('d M Y') }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-9 w-9">
                                        @if($leave->pegawai && $leave->pegawai->foto_profil)
                                            <img class="h-9 w-9 rounded-full object-cover" src="{{ asset('storage/profile-photos/'.$leave->pegawai->foto_profil) }}" alt="">
                                        @else
                                            <div class="h-9 w-9 rounded-full bg-emerald-500 flex items-center justify-center text-white font-medium text-sm">
                                                {{ $leave->pegawai ? substr($leave->pegawai->nama, 0, 1) : '?' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-slate-800">
                                            {{ $leave->pegawai ? $leave->pegawai->nama : 'Unknown' }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            {{ $leave->pegawai ? $leave->pegawai->nip : '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-800">{{ $leave->jumlah_hari }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-800">
                                    {{ $leave->pegawai && $leave->pegawai->unitKerja ? $leave->pegawai->unitKerja->nama_unit : '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-800 line-clamp-2">{{ $leave->alasan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                    $leave->isApproved() ? 'bg-emerald-100 text-emerald-800' : 
                                    ($leave->isPending() ? 'bg-amber-100 text-amber-800' : 
                                    ($leave->isRejected() ? 'bg-rose-100 text-rose-800' : 'bg-slate-100 text-slate-800')) 
                                }}">
                                    {{ 
                                        $leave->isApproved() ? 'Disetujui' : 
                                        ($leave->isPending() ? 'Menunggu' : 
                                        ($leave->isRejected() ? 'Ditolak' : 'Dibatalkan')) 
                                    }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-800">
                                    {{ $leave->approvedBy ? $leave->approvedBy->nama : '-' }}
                                </div>
                                @if($leave->catatan)
                                    <div class="text-xs text-slate-500 italic">
                                        "{{ Str::limit($leave->catatan, 30) }}"
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-slate-500 font-medium mb-1">Tidak ada data cuti</p>
                                    <p class="text-slate-400 text-sm">Tidak ada data cuti yang tersedia untuk periode ini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($leaves->hasPages())
            <div class="border-t border-slate-200 px-6 py-3">
                {{ $leaves->links() }}
            </div>
        @endif
    </div>
    
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
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    showConfirmButton: true
                });
            });
        });
        
        function initCharts() {
            // Monthly Chart
            initMonthlyChart();
            
            // Department Chart
            initDepartmentChart();
        }
        
        function initMonthlyChart() {
            const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const monthlyCtx = document.getElementById('monthlyChart');
            
            if (monthlyCtx) {
                // Get stats from Livewire component
                const monthlyStats = @json($monthlyStats);
                
                if (window.monthlyChart instanceof Chart) {
                    window.monthlyChart.destroy();
                }
                
                window.monthlyChart = new Chart(monthlyCtx, {
                    type: 'bar',
                    data: {
                        labels: monthLabels,
                        datasets: [{
                            label: 'Hari Cuti',
                            data: monthlyStats,
                            backgroundColor: 'rgba(16, 185, 129, 0.7)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        }
        
        function initDepartmentChart() {
            const departmentCtx = document.getElementById('departmentChart');
            
            if (departmentCtx) {
                // Get stats from Livewire component
                const departmentStats = @json($departmentStats);
                const labels = [];
                const data = [];
                const backgroundColors = [
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(245, 158, 11, 0.7)',
                    'rgba(239, 68, 68, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(236, 72, 153, 0.7)',
                    'rgba(6, 182, 212, 0.7)',
                    'rgba(132, 204, 22, 0.7)'
                ];
                
                // Extract data from departmentStats
                Object.values(departmentStats).forEach((dept, index) => {
                    if (dept.days > 0) {
                        labels.push(dept.name);
                        data.push(dept.days);
                    }
                });
                
                if (window.departmentChart instanceof Chart) {
                    window.departmentChart.destroy();
                }
                
                window.departmentChart = new Chart(departmentCtx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgroundColors,
                            borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    usePointStyle: true
                                }
                            }
                        },
                        cutout: '65%'
                    }
                });
            }
        }
    </script>
    
    <!-- Alpine.js Dropdown Control -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
                toggle() {
                    this.open = !this.open;
                },
                close() {
                    this.open = false;
                }
            }));
        });
    </script>
</div>