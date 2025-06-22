<!-- filepath: d:\laragon\www\Sistem-Perusahaan\resources\views\livewire\position\manage-position.blade.php -->
<div class="py-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 flex items-center">
                <span class="bg-purple-600/10 text-purple-600 p-1.5 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
                Manajemen Jabatan
            </h1>
            <p class="mt-1 text-sm text-slate-600">
                Kelola jabatan dan posisi dalam perusahaan
            </p>
        </div>
        
        <div class="mt-4 md:mt-0 flex flex-col md:flex-row gap-3">
            <a href="{{ route('position.create') }}" class="flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span class="font-medium">Tambah Jabatan</span>
                <span class="ml-2 scale-0 opacity-0 group-hover:scale-100 group-hover:opacity-100 transition-all duration-200 bg-white/20 text-xs font-medium rounded-full py-0.5 px-2">Baru</span>
            </a>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Jabatan -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 flex items-center">
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-400">Total Jabatan</div>
                <div class="text-2xl font-bold text-slate-900">{{ number_format($stats['total']) }}</div>
            </div>
        </div>
        
        <!-- Jabatan dengan Pegawai -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 flex items-center">
            <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-400">Jabatan Terisi</div>
                <div class="text-2xl font-bold text-slate-900">{{ number_format($stats['with_employees']) }}</div>
                <div class="text-xs text-slate-500 mt-1">
                    @if($stats['total'] > 0)
                        {{ round(($stats['with_employees'] / $stats['total']) * 100) }}% dari total jabatan
                    @else
                        0% dari total jabatan
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Distribusi Role -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6">
            <h3 class="text-sm font-medium text-slate-400 mb-2">Distribusi Role</h3>
            <div class="space-y-2">
                @forelse($stats['by_role'] as $role_stat)
                    @if($role_stat->role)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-600">{{ $role_stat->role->name }}</span>
                            <span class="font-medium text-slate-900">{{ $role_stat->count }}</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-1.5">
                            <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? ($role_stat->count / $stats['total'] * 100) : 0 }}%"></div>
                        </div>
                    @endif
                @empty
                    <div class="text-sm text-slate-500">Tidak ada data role</div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Search and View Toggle -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 mb-8 relative">
        <div class="flex flex-col md:flex-row justify-between gap-4">
            <div class="flex-1">
                <label for="search" class="sr-only">Cari</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" id="search" name="search" class="block w-full bg-white border border-slate-200 rounded-lg py-2.5 pl-10 pr-3 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Cari nama jabatan..." type="search">
                </div>
            </div>
            
            <div class="flex flex-wrap items-center gap-4">
                <div>
                    <label for="filterRole" class="sr-only">Filter Role</label>
                    <select wire:model.live="filterRole" id="filterRole" name="filterRole" class="block w-full bg-white border border-slate-200 rounded-lg py-2.5 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Semua Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-center space-x-2">
                    <button wire:click="switchViewMode('grid')" class="p-2 rounded-lg {{ $viewMode === 'grid' ? 'bg-purple-50 text-purple-600' : 'bg-white text-slate-500 hover:bg-slate-100' }} focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </button>
                    <button wire:click="switchViewMode('table')" class="p-2 rounded-lg {{ $viewMode === 'table' ? 'bg-purple-50 text-purple-600' : 'bg-white text-slate-500 hover:bg-slate-100' }} focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Grid View -->
    @if($viewMode === 'grid')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($positions as $position)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-md transition-shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $position->role ? 'from-purple-500 to-indigo-600' : 'from-slate-400 to-slate-500' }} flex items-center justify-center text-white font-semibold text-lg">
                            {{ strtoupper(substr($position->nama_jabatan, 0, 1)) }}
                        </div>
                        <div class="ml-3">
                            <h3 class="font-semibold text-slate-900">{{ $position->nama_jabatan }}</h3>
                            <p class="text-xs text-slate-500">{{ $position->role ? $position->role->name : 'No Role' }}</p>
                        </div>
                    </div>
                    <div class="dropdown relative">
                        <button class="p-1.5 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200 py-1 z-10">
                            <a href="{{ route('position.edit', $position->id) }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                Edit Jabatan
                            </a>
                            <button wire:click="confirmDelete({{ $position->id }})" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Hapus Jabatan
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-3 mb-4">
                    <!-- Tunjangan -->
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm text-slate-600">
                            Tunjangan: 
                            <span class="font-medium text-slate-800">
                                Rp {{ number_format($position->tunjangan, 0, ',', '.') }}
                            </span>
                        </span>
                    </div>
                    
                    <!-- Jumlah Pegawai -->
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="text-sm text-slate-600">
                            {{ $position->pegawais->count() }} Pegawai
                        </span>
                    </div>
                </div>
                
                <div class="flex justify-end mt-4 space-x-2">
                    <a href="{{ route('position.edit', $position->id) }}" class="px-3 py-1.5 bg-purple-50 text-purple-600 rounded-lg text-sm font-medium hover:bg-purple-100 transition-colors">
                        Edit
                    </a>
                    <button wire:click="confirmDelete({{ $position->id }})" class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors">
                        Hapus
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl shadow-sm border border-slate-200/60 p-8 text-center">
                <div class="mx-auto w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-1">Tidak ada jabatan ditemukan</h3>
                <p class="text-slate-600 mb-6">Belum ada data jabatan yang tersedia atau sesuai dengan pencarian Anda</p>
                <a href="{{ route('position.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Jabatan Pertama
                </a>
            </div>
        @endforelse
    </div>
    @else
    <!-- Table View -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead>
                    <tr class="bg-slate-50">
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('nama_jabatan')">
                                Nama Jabatan
                                @if($sortField === 'nama_jabatan')
                                    @if($sortDirection === 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('role_id')">
                                Role
                                @if($sortField === 'role_id')
                                    @if($sortDirection === 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('tunjangan')">
                                Tunjangan
                                @if($sortField === 'tunjangan')
                                    @if($sortDirection === 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Jumlah Pegawai
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($positions as $position)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br {{ $position->role ? 'from-purple-500 to-indigo-600' : 'from-slate-400 to-slate-500' }} flex items-center justify-center text-white font-medium">
                                        {{ strtoupper(substr($position->nama_jabatan, 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-slate-900">{{ $position->nama_jabatan }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($position->role)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                        $position->role->name === 'Admin' ? 'bg-red-100 text-red-800' : 
                                        ($position->role->name === 'Manager' ? 'bg-blue-100 text-blue-800' : 
                                        'bg-green-100 text-green-800') 
                                    }}">
                                        {{ $position->role->name }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                        No Role
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-900">Rp {{ number_format($position->tunjangan, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ $position->pegawais->count() }} pegawai
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end items-center space-x-2">
                                    <a href="{{ route('position.edit', $position->id) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-purple-600 hover:bg-purple-50 transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button wire:click="confirmDelete({{ $position->id }})" class="p-1.5 rounded-lg text-slate-500 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <span class="text-slate-500 text-lg font-medium">Tidak ada data jabatan yang tersedia</span>
                                    <p class="text-slate-400 mt-1">Tambahkan jabatan baru untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif
    
    <!-- Pagination -->
    @if($positions->hasPages())
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 px-4 py-3 flex items-center justify-between">
            <div class="flex-1 flex justify-between sm:hidden">
                {{ $positions->links('pagination::simple-tailwind') }}
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-slate-700">
                        Menampilkan
                        <span class="font-medium">{{ ($positions->currentPage() - 1) * $positions->perPage() + 1 }}</span>
                        sampai
                        <span class="font-medium">{{ min($positions->currentPage() * $positions->perPage(), $positions->total()) }}</span>
                        dari
                        <span class="font-medium">{{ $positions->total() }}</span>
                        hasil
                    </p>
                </div>
                <div>
                    {{ $positions->links() }}
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
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-slate-900" id="modal-title">
                                Hapus Jabatan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-slate-600">
                                    Apakah Anda yakin ingin menghapus jabatan ini? 
                                    @if($selectedPosition && $selectedPosition->pegawais->count() > 0)
                                    <span class="font-semibold text-red-600">Jabatan ini memiliki {{ $selectedPosition->pegawais->count() }} pegawai.</span> 
                                    Tindakan ini dapat menyebabkan masalah pada data pegawai terkait. Tindakan ini tidak dapat dibatalkan.
                                    @else
                                    Tindakan ini tidak dapat dibatalkan.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button 
                        wire:click="deletePosition" 
                        type="button" 
                        class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-base font-medium text-white hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        Hapus
                    </button>
                    <button 
                        wire:click="$set('isConfirmingDelete', false)" 
                        type="button" 
                        class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2.5 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Sweet Alert Script -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('swal:modal', (data) => {
                Swal.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.text,
                    showConfirmButton: data.showConfirmButton || true,
                    timer: data.timer || undefined,
                });
            });
        });
        
        // Initialize dropdowns
        document.addEventListener('click', function(e) {
            const dropdowns = document.querySelectorAll('.dropdown');
            
            dropdowns.forEach(function(dropdown) {
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                const dropdownToggle = dropdown.querySelector('button');
                
                if (dropdownToggle && dropdownToggle.contains(e.target)) {
                    // Toggle current dropdown
                    dropdownMenu.classList.toggle('hidden');
                } else if (!dropdownMenu.contains(e.target)) {
                    // Close if clicked outside
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</div>