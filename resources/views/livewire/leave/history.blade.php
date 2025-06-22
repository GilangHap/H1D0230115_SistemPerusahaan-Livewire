<!-- filepath: d:\laragon\www\Sistem-Perusahaan\resources\views\livewire\leave\history.blade.php -->
<div class="space-y-6">
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-indigo-100 to-blue-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-xl font-semibold text-slate-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                    Riwayat Cuti
                </h1>
                <p class="text-slate-500 mt-1 pl-8">Lihat dan kelola riwayat pengajuan cuti Anda</p>
            </div>
            
            <div class="flex items-center px-5 py-3 bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 rounded-lg border border-indigo-100/80 shadow-sm">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-500 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <span class="text-sm font-medium text-slate-500">Sisa Cuti</span>
                    <div class="flex items-center">
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">{{ $remainingLeaves }}</span>
                        <span class="ml-1 text-indigo-600">hari</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
        <div class="flex flex-col md:flex-row gap-4 md:items-end">
            <div class="flex-1 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Month Filter -->
                    <div>
                        <label for="month" class="block text-xs font-medium text-slate-600 mb-1">Bulan</label>
                        <select 
                            id="month" 
                            wire:model.live="month"
                            class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">Semua Bulan</option>
                            @foreach($months as $key => $monthName)
                                <option value="{{ $key }}">{{ $monthName }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Year Filter -->
                    <div>
                        <label for="year" class="block text-xs font-medium text-slate-600 mb-1">Tahun</label>
                        <select 
                            id="year" 
                            wire:model.live="year"
                            class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">Semua Tahun</option>
                            @foreach($years as $yearOption)
                                <option value="{{ $yearOption }}">{{ $yearOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-xs font-medium text-slate-600 mb-1">Status</label>
                        <select 
                            id="status" 
                            wire:model.live="filterStatus"
                            class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">Semua Status</option>
                            <option value="approved">Disetujui</option>
                            <option value="pending">Menunggu</option>
                            <option value="rejected">Ditolak</option>
                            <option value="canceled">Dibatalkan</option>
                        </select>
                    </div>
                    
                    <!-- Search Filter -->
                    <div>
                        <label for="search" class="block text-xs font-medium text-slate-600 mb-1">Pencarian</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="search" 
                                wire:model.live.debounce.300ms="searchQuery"
                                class="pl-10 w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Cari alasan/catatan..."
                            >
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Reset Button -->
            <div>
                <button 
                    wire:click="resetFilters"
                    class="px-4 py-2.5 w-full md:w-auto bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-lg transition-colors inline-flex items-center justify-center"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset Filter
                </button>
            </div>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Requests -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tl from-slate-50 to-slate-100 rounded-full -mr-16 -mb-16"></div>
            <div class="relative">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Pengajuan</p>
                        <p class="text-2xl font-bold text-slate-800 mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="rounded-full bg-slate-100 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                @if($stats['total'] > 0)
                    <div class="mt-3 pt-3 border-t border-slate-100">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-slate-500">Total Hari Cuti</span>
                            <span class="text-sm font-semibold text-slate-700">{{ $totalDays + $pendingDays }} hari</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Approved -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tl from-green-50 to-emerald-50 rounded-full -mr-16 -mb-16"></div>
            <div class="relative">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Disetujui</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['approved'] }}</p>
                    </div>
                    <div class="rounded-full bg-green-100 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                @if($stats['approved'] > 0)
                    <div class="mt-3 pt-3 border-t border-green-100">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-slate-500">Total Hari</span>
                            <span class="text-sm font-semibold text-green-600">{{ $totalDays }} hari</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Pending -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tl from-amber-50 to-yellow-50 rounded-full -mr-16 -mb-16"></div>
            <div class="relative">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Menunggu</p>
                        <p class="text-2xl font-bold text-amber-600 mt-1">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="rounded-full bg-amber-100 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                @if($stats['pending'] > 0)
                    <div class="mt-3 pt-3 border-t border-amber-100">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-slate-500">Menunggu</span>
                            <span class="text-sm font-semibold text-amber-600">{{ $pendingDays }} hari</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Rejected and Canceled -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tl from-red-50 to-rose-50 rounded-full -mr-16 -mb-16"></div>
            <div class="relative">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Ditolak & Dibatalkan</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">{{ $stats['rejected'] + $stats['canceled'] }}</p>
                    </div>
                    <div class="rounded-full bg-red-100 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                @if(($stats['rejected'] + $stats['canceled']) > 0)
                    <div class="mt-3 pt-3 border-t border-red-100">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-slate-500">Detail</span>
                            <span class="text-xs font-semibold">
                                <span class="text-red-600">{{ $stats['rejected'] }} ditolak</span>
                                <span class="text-slate-400 mx-1">|</span>
                                <span class="text-slate-600">{{ $stats['canceled'] }} dibatalkan</span>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Leave History Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Durasi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Alasan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Catatan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Tanggal Pengajuan
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse ($leaveRequests as $leave)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        {{ \Carbon\Carbon::parse($leave->tanggal_mulai)->format('d M Y') }}
                                        <span class="text-slate-400 mx-1">-</span>
                                        {{ \Carbon\Carbon::parse($leave->tanggal_akhir)->format('d M Y') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $leave->jumlah_hari }} hari
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($leave->status)
                                    @case('approved')
                                        <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                            Disetujui
                                        </span>
                                        @break
                                    @case('pending')
                                        <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse mr-1.5"></span>
                                            Menunggu
                                        </span>
                                        @break
                                    @case('rejected')
                                        <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border border-red-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                            Ditolak
                                        </span>
                                        @break
                                    @case('canceled')
                                        <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800 border border-slate-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500 mr-1.5"></span>
                                            Dibatalkan
                                        </span>
                                        @break
                                    @default
                                        <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-slate-100 text-slate-800">
                                            {{ ucfirst($leave->status) }}
                                        </span>
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700 max-w-xs">
                                <div class="line-clamp-2 hover:line-clamp-none transition-all duration-300">{{ $leave->alasan }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700 max-w-xs">
                                @if($leave->catatan)
                                    <div class="line-clamp-2 hover:line-clamp-none transition-all duration-300">{{ $leave->catatan }}</div>
                                @else
                                    <span class="text-slate-400 italic">Tidak ada catatan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                {{ \Carbon\Carbon::parse($leave->created_at)->format('d M Y H:i') }}
                                <div class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($leave->created_at)->diffForHumans() }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-slate-100 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-base font-medium text-slate-600 mb-1">Tidak ada data</p>
                                    <p class="text-sm text-slate-500 max-w-sm text-center mb-4">Tidak ada riwayat pengajuan cuti yang ditemukan dengan filter yang dipilih.</p>
                                    
                                    <div class="flex gap-3">
                                        <button 
                                            wire:click="resetFilters"
                                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-lg transition-colors flex items-center"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Reset Filter
                                        </button>
                                        
                                        <a 
                                            href="{{ route('leave.apply') }}" 
                                            class="px-4 py-2 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 text-sm font-medium rounded-lg transition-colors flex items-center"
                                            wire:navigate
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Ajukan Cuti
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if ($leaveRequests->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $leaveRequests->links() }}
            </div>
        @endif
    </div>
    
    <!-- Quick Actions -->
    <div class="flex flex-wrap gap-3 justify-end">
        <a 
            href="{{ route('leave.apply') }}" 
            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors flex items-center shadow-sm hover:shadow"
            wire:navigate
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Ajukan Cuti Baru
        </a>
    </div>
</div>