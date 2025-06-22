<div class="py-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 flex items-center">
                <span class="bg-blue-600/10 text-blue-600 p-1.5 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                Manajemen Pegawai
            </h1>
            <p class="mt-1 text-sm text-slate-600">Kelola seluruh data pegawai dalam sistem</p>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('member.create') }}" wire:navigate class="flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span class="font-medium">Tambah Pegawai</span>
                <span class="ml-2 scale-0 opacity-0 group-hover:scale-100 group-hover:opacity-100 transition-all duration-200 bg-white/20 text-xs font-medium rounded-full py-0.5 px-2">Baru</span>
            </a>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-sm border border-blue-100/40 p-6 relative overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
            <div class="absolute right-0 top-0 w-24 h-24 rounded-bl-3xl bg-blue-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1.5 uppercase tracking-wider">Total Pegawai</p>
                <div class="flex items-baseline">
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['total'] }}</h3>
                    <span class="ml-2 text-xs font-medium text-green-600 bg-green-100 px-1.5 py-0.5 rounded">Aktif</span>
                </div>
                <div class="mt-3 text-xs text-slate-500">
                    <span class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Terakhir diperbarui: {{ now()->format('d M Y') }}</span>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl shadow-sm border border-purple-100/40 p-6 relative overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
            <div class="absolute right-0 top-0 w-24 h-24 rounded-bl-3xl bg-purple-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-500/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1.5 uppercase tracking-wider">Departemen</p>
                <div class="flex items-baseline">
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['departments'] }}</h3>
                </div>
                <div class="mt-3">
                    <a href="#" class="text-xs text-purple-600 font-medium flex items-center hover:text-purple-800 transition-colors">
                        <span>Kelola Departemen</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-white to-emerald-50 rounded-2xl shadow-sm border border-emerald-100/40 p-6 relative overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
            <div class="absolute right-0 top-0 w-24 h-24 rounded-bl-3xl bg-emerald-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-500/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1.5 uppercase tracking-wider">Jabatan</p>
                <div class="flex items-baseline">
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['positions'] }}</h3>
                </div>
                <div class="mt-3">
                    <a href="#" class="text-xs text-emerald-600 font-medium flex items-center hover:text-emerald-800 transition-colors">
                        <span>Kelola Jabatan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search and Filters -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 mb-8 backdrop-blur-sm relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-slate-100 opacity-20"></div>
        <div class="relative">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="relative">
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search" 
                            placeholder="Cari nama, NIP, email..." 
                            class="pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm w-full md:w-72 focus:ring-blue-500 focus:border-blue-500 bg-white/80 focus:bg-white transition-colors" 
                        />
                        <div class="absolute left-3 top-3 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    
                    <button 
                        wire:click="toggleFilters" 
                        class="btn-secondary-modern group"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span class="flex items-center">
                            Filter
                            @if(!empty($filterDepartment) || !empty($filterPosition))
                                <span class="ml-1.5 flex items-center justify-center w-5 h-5 bg-blue-100 text-blue-600 text-xs font-semibold rounded-full">
                                    {{ (!empty($filterDepartment) ? 1 : 0) + (!empty($filterPosition) ? 1 : 0) }}
                                </span>
                            @endif
                        </span>
                    </button>
                </div>
                
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center">
                        <label for="perPage" class="text-sm text-slate-500 font-medium mr-2">Tampilkan:</label>
                        <select 
                            id="perPage" 
                            wire:model.live="perPage"
                            class="border border-slate-200 rounded-lg text-sm pr-8 pl-3 py-1.5 focus:ring-blue-500 focus:border-blue-500 bg-white/80 focus:bg-white transition-colors"
                        >
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Expanded Filters -->
            @if($showFilters)
                <div class="mt-5 pt-5 border-t border-slate-200/70">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label for="filterDepartment" class="block text-sm font-medium text-slate-700 mb-1.5">Departemen</label>
                            <select 
                                id="filterDepartment" 
                                wire:model.live="filterDepartment"
                                class="border border-slate-200 rounded-xl text-sm pr-10 pl-3 py-2.5 w-full focus:ring-blue-500 focus:border-blue-500 bg-white/80 focus:bg-white transition-colors"
                            >
                                <option value="">Semua Departemen</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="filterPosition" class="block text-sm font-medium text-slate-700 mb-1.5">Jabatan</label>
                            <select 
                                id="filterPosition" 
                                wire:model.live="filterPosition"
                                class="border border-slate-200 rounded-xl text-sm pr-10 pl-3 py-2.5 w-full focus:ring-blue-500 focus:border-blue-500 bg-white/80 focus:bg-white transition-colors"
                            >
                                <option value="">Semua Jabatan</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex items-end">
                            <button 
                                wire:click="resetFilters" 
                                class="text-sm text-slate-600 hover:text-blue-600 flex items-center transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset Filter
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Employee List Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    wire:model.live="selectAll" 
                                    class="w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500"
                                >
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 font-semibold cursor-pointer" wire:click="sortBy('nip')">
                            <div class="flex items-center">
                                NIP
                                @if($sortField === 'nip')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        @if($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 font-semibold cursor-pointer" wire:click="sortBy('nama')">
                            <div class="flex items-center">
                                Nama Lengkap
                                @if($sortField === 'nama')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        @if($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 font-semibold cursor-pointer" wire:click="sortBy('email')">
                            <div class="flex items-center">
                                Email
                                @if($sortField === 'email')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        @if($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 font-semibold">Departemen</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Jabatan</th>
                        <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/70 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input 
                                    type="checkbox" 
                                    value="{{ $employee->id }}"
                                    wire:model.live="selectedEmployees"
                                    class="w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500"
                                >
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-medium text-slate-700">{{ $employee->nip }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full overflow-hidden bg-slate-200 flex-shrink-0 ring-2 ring-white">
                                        @if($employee->foto_profil)
                                            <img src="{{ asset('storage/profile-photos/' . $employee->foto_profil) }}" alt="{{ $employee->nama }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-600 text-white font-semibold">
                                                {{ substr($employee->nama, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium text-slate-900">{{ $employee->nama }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $employee->no_telp ?? 'Tidak ada nomor telepon' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $employee->email }}</td>
                            <td class="px-6 py-4">
                                @if($employee->unitKerja)
                                    <div class="inline-flex items-center px-2 py-1 bg-purple-50 text-purple-700 rounded-md text-xs font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        {{ $employee->unitKerja->nama_unit }}
                                    </div>
                                @else
                                    <span class="text-slate-400 text-xs">Tidak ditetapkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($employee->jabatan)
                                    <span class="px-2.5 py-1 text-xs rounded-full bg-blue-50 text-blue-700 font-medium border border-blue-100">
                                        {{ $employee->jabatan->nama_jabatan }}
                                    </span>
                                @else
                                    <span class="text-slate-400 text-xs">Tidak ditetapkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex justify-end items-center gap-2">
                                    <button 
                                        wire:click="executeAction('view', {{ $employee->id }})"
                                        class="p-1.5 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-colors"
                                        title="Lihat Detail"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <a 
                                        href="{{ route('member.edit', ['id' => $employee->id]) }}"
                                        wire:navigate
                                        class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition-colors"
                                        title="Edit"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button 
                                        wire:click="executeAction('delete', {{ $employee->id }})"
                                        class="p-1.5 rounded-lg text-slate-500 hover:text-red-600 hover:bg-red-50 transition-colors"
                                        title="Hapus"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 font-medium">Tidak ada data pegawai yang ditemukan</p>
                                    <p class="text-slate-400 text-sm mt-1">Mungkin belum ada data atau kriteria pencarian tidak cocok</p>
                                    @if(!empty($search) || !empty($filterDepartment) || !empty($filterPosition))
                                        <button 
                                            wire:click="resetFilters" 
                                            class="mt-4 text-sm bg-blue-50 text-blue-600 hover:bg-blue-100 font-medium flex items-center px-3 py-1.5 rounded-lg transition-colors"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Reset Pencarian & Filter
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 border-t border-slate-100">
            {{ $employees->links() }}
        </div>
        
        <!-- Bulk Actions -->
        @if(!empty($selectedEmployees))
            <div class="p-4 border-t border-slate-100 bg-gradient-to-r from-blue-50 to-indigo-50 flex flex-wrap items-center justify-between gap-3">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm text-slate-600 font-medium">
                        <span class="bg-blue-100 text-blue-800 font-semibold px-2 py-0.5 rounded-full text-xs">{{ count($selectedEmployees) }}</span>
                        pegawai terpilih
                    </span>
                    <button 
                        wire:click="$set('selectedEmployees', [])"
                        class="text-xs text-slate-500 hover:text-slate-700 underline"
                    >
                        Batalkan pilihan
                    </button>
                </div>
                
                <div class="flex items-center">
                    <select 
                        wire:model.live="bulkAction"
                        class="border border-slate-200 rounded-lg text-sm pr-8 pl-3 py-2 mr-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">Pilih Aksi Massal</option>
                        <option value="delete">Hapus Pegawai</option>
                    </select>
                    <button 
                        wire:click="executeBulkAction"
                        class="btn-primary"
                        @if(empty($bulkAction)) disabled @endif
                    >
                        Terapkan
                    </button>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Employee Detail Modal -->
    @if($isViewingDetails && $selectedEmployee)
        <div class="fixed inset-0 z-[9999] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay with blur -->
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                
                <!-- Modal -->
                <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-gradient-to-b from-white to-slate-50 p-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-bold text-slate-800 flex items-center">
                                <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                Detail Pegawai
                            </h3>
                            <button 
                                wire:click="closeDetails" 
                                class="text-slate-400 hover:text-slate-500 p-1 rounded-full hover:bg-slate-100 transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Left Column: Profile Overview -->
                            <div class="md:col-span-1">
                                <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl p-6 text-center border border-blue-100/30 shadow-sm">
                                    <div class="w-28 h-28 rounded-full mx-auto overflow-hidden bg-slate-100 mb-4 ring-4 ring-white shadow-md">
                                        @if($selectedEmployee->foto_profil)
                                            <img src="{{ asset('storage/profile-photos/' . $selectedEmployee->foto_profil) }}" alt="{{ $selectedEmployee->nama }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-600 text-white text-3xl font-bold">
                                                {{ substr($selectedEmployee->nama, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <h4 class="text-lg font-bold text-slate-800">{{ $selectedEmployee->nama }}</h4>
                                    <p class="text-blue-600 text-sm font-medium mt-1">
                                        {{ $selectedEmployee->jabatan ? $selectedEmployee->jabatan->nama_jabatan : 'Tidak ada jabatan' }}
                                    </p>
                                    <p class="text-slate-500 text-sm mt-1">
                                        {{ $selectedEmployee->unitKerja ? $selectedEmployee->unitKerja->nama_unit : 'Tidak ada departemen' }}
                                    </p>
                                    
                                    <div class="mt-4 text-sm">
                                        <div class="bg-blue-50 text-blue-700 rounded-lg py-2 px-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                            </svg>
                                            {{ $selectedEmployee->nip }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4 flex flex-col gap-2">
                                    <a 
                                        href="{{ route('member.edit', ['id' => $employee->id]) }}"
                                        wire:navigate
                                        class="w-full py-2.5 flex justify-center items-center text-sm font-medium bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl transition-all shadow-sm hover:shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit Data Pegawai
                                    </a>
                                    <button 
                                        wire:click="executeAction('delete', {{ $selectedEmployee->id }})"
                                        class="w-full py-2.5 flex justify-center items-center text-sm font-medium bg-white hover:bg-red-50 text-red-600 hover:text-red-700 border border-red-200 rounded-xl transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus Pegawai
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Right Column: Detail Tabs -->
                            <div class="md:col-span-2">
                                <!-- Tab Navigation -->
                                <div class="border-b border-slate-200 mb-6">
                                    <nav class="-mb-px flex space-x-6">
                                        <button 
                                            wire:click="changeTab('profile')" 
                                            class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $selectedTab === 'profile' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                                            Informasi Dasar
                                        </button>
                                        <button 
                                            wire:click="changeTab('employment')" 
                                            class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $selectedTab === 'employment' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                                            Informasi Kepegawaian
                                        </button>
                                        <button 
                                            wire:click="changeTab('contact')" 
                                            class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $selectedTab === 'contact' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                                            Kontak & Alamat
                                        </button>
                                    </nav>
                                </div>
                                
                                <!-- Tab Content -->
                                
                                <!-- Profile Tab -->
                                <div class="{{ $selectedTab === 'profile' ? 'block' : 'hidden' }} space-y-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Nama Lengkap</h4>
                                            <p class="text-base text-slate-800 font-medium">{{ $selectedEmployee->nama }}</p>
                                        </div>
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">NIP</h4>
                                            <p class="text-base text-slate-800 font-medium">{{ $selectedEmployee->nip }}</p>
                                        </div>
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Email</h4>
                                            <p class="text-base text-slate-800 font-medium">{{ $selectedEmployee->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Employment Tab -->
                                <div class="{{ $selectedTab === 'employment' ? 'block' : 'hidden' }} space-y-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Departemen</h4>
                                            <p class="text-base text-slate-800 font-medium">
                                                @if($selectedEmployee->unitKerja)
                                                    <span class="inline-flex items-center">
                                                        <span class="w-3 h-3 rounded-full bg-purple-400 mr-2"></span>
                                                        {{ $selectedEmployee->unitKerja->nama_unit }}
                                                    </span>
                                                @else
                                                    <span class="text-slate-400">Tidak ditetapkan</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Jabatan</h4>
                                            <p class="text-base text-slate-800 font-medium">
                                                @if($selectedEmployee->jabatan)
                                                    <span class="inline-flex items-center">
                                                        <span class="w-3 h-3 rounded-full bg-blue-400 mr-2"></span>
                                                        {{ $selectedEmployee->jabatan->nama_jabatan }}
                                                    </span>
                                                @else
                                                    <span class="text-slate-400">Tidak ditetapkan</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Tanggal Bergabung</h4>
                                            <p class="text-base text-slate-800 font-medium">{{ $selectedEmployee->created_at ? \Carbon\Carbon::parse($selectedEmployee->created_at)->format('d F Y') : '-' }}</p>
                                        </div>
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Status Kepegawaian</h4>
                                            <p class="text-base  text-slate-800 font-medium">{{ $selectedEmployee->status_kepegawaian ?? 'Active' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Contact Tab -->
                                <div class="{{ $selectedTab === 'contact' ? 'block' : 'hidden' }} space-y-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Nomor Telepon</h4>
                                            <p class="text-base text-slate-800 font-medium flex items-center">
                                                @if($selectedEmployee->no_telp)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                    </svg>
                                                    {{ $selectedEmployee->no_telp }}
                                                @else
                                                    <span class="text-slate-400">Tidak ada</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all md:col-span-2">
                                            <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Alamat</h4>
                                            <p class="text-base text-slate-800 font-medium flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                @if($selectedEmployee->alamat)
                                                    {{ $selectedEmployee->alamat }}
                                                @else
                                                    <span class="text-slate-400">Tidak ada</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Delete Confirmation Modal -->
    @if($isConfirmingDelete)
        <div class="fixed inset-0 z-[9999] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                
                <!-- Modal -->
                <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white p-6 sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-bold text-slate-900" id="modal-title">
                                    Hapus Pegawai
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-600">
                                        Apakah Anda yakin ingin menghapus pegawai ini? Data yang telah dihapus tidak dapat dikembalikan.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse gap-2">
                            <button 
                                wire:click="deleteEmployee"
                                class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-2.5 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Hapus
                            </button>
                            <button 
                                wire:click="cancelDelete"
                                class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-6 py-2.5 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Sweet Alert Script -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showAlert', ({type, message}) => {
                Swal.fire({
                    icon: type,
                    title: type === 'success' ? 'Berhasil!' : 'Perhatian!',
                    text: message,
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    showClass: {
                        popup: 'animate__animated animate__fadeInRight animate__faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutRight animate__faster'
                    }
                });
            });
        });
    </script>
    
    <!-- Dynamic Grid Background -->
    <div class="fixed inset-0 z-[-1] bg-grid-slate-100"></div>
    
    <!-- Additional Styling -->
    <style>
        /* Grid Background Pattern */
        .bg-grid-slate-100 {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23e2e8f0' fill-opacity='0.4'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Custom Pagination Styling */
        nav[aria-label="Pagination Navigation"] {
            @apply flex items-center justify-between;
        }
        
        nav[aria-label="Pagination Navigation"] > div:first-child {
            @apply hidden;
        }
        
        nav[aria-label="Pagination Navigation"] > div:last-child {
            @apply w-full space-x-2 flex justify-center mt-2;
        }
        
        nav[aria-label="Pagination Navigation"] span[aria-current="page"] > span {
            @apply bg-gradient-to-r from-blue-500 to-blue-600 text-white border-transparent relative inline-flex items-center px-5 py-2 text-sm font-medium rounded-lg shadow-sm;
        }
        
        nav[aria-label="Pagination Navigation"] a {
            @apply bg-white border-slate-200 text-slate-700 hover:bg-slate-50 relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg border transition-colors;
        }
        
        /* Button Styling */
        .btn-primary {
            @apply relative overflow-hidden flex items-center justify-center px-4 py-2.5 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200;
        }
        
        .btn-secondary-modern {
            @apply relative overflow-hidden flex items-center justify-center px-4 py-2.5 border border-slate-200 rounded-xl shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200;
        }

        /* Hover animations */
        .hover-lift {
            @apply transition-transform duration-200 ease-in-out;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
        }

        /* Badge animations */
        @keyframes pulse-badge {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .pulse-badge {
            animation: pulse-badge 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

    <!-- Empty State for No Departments -->
    @if($stats['departments'] === 0)
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = true, 500)" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-4"
             class="fixed bottom-6 left-6 max-w-sm bg-white border border-slate-200 rounded-xl shadow-lg p-5">
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-amber-100 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-semibold text-slate-800">Perhatian!</h3>
                    <div class="mt-1.5 text-sm text-slate-600">
                        <p>Belum ada departemen yang tersedia. Silakan buat departemen terlebih dahulu untuk mengorganisir pegawai.</p>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center group">
                            Kelola Departemen
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button @click="show = false" type="button" class="inline-flex bg-white rounded-md p-1 text-slate-400 hover:text-slate-500 focus:outline-none">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate a random loading time for list when filters change
            Livewire.hook('message.processed', (message, component) => {
                if (component.fingerprint.name === 'member.all-member' && 
                    (message.updateQueue.find(u => u.payload.name === 'filterDepartment') || 
                     message.updateQueue.find(u => u.payload.name === 'filterPosition'))) {
                    
                    const tableRows = document.querySelectorAll('tbody tr');
                    tableRows.forEach((row, index) => {
                        setTimeout(() => {
                            row.classList.add('animate__animated', 'animate__fadeIn');
                            setTimeout(() => {
                                row.classList.remove('animate__animated', 'animate__fadeIn');
                            }, 500);
                        }, index * 50);
                    });
                }
            });
            
            // Handle export success notification
            window.addEventListener('excel:download-started', function() {
                const downloadingToast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                
                downloadingToast.fire({
                    icon: 'info',
                    title: 'Mendownload data pegawai...'
                });
            });
            
            window.addEventListener('excel:download-finished', function() {
                window.dispatchEvent(new CustomEvent('download-complete'));
            });
        });
    </script>

    <!-- Animate.css Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</div>