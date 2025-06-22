<div class="py-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 flex items-center">
                <span class="bg-indigo-600/10 text-indigo-600 p-1.5 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </span>
                Manajemen Departemen
            </h1>
            <p class="mt-1 text-sm text-slate-600">Kelola departemen atau unit kerja perusahaan</p>
        </div>
        
        <div class="mt-4 md:mt-0 flex flex-col md:flex-row gap-3">
            <a href="{{ route('departement.create') }}" wire:navigate class="flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span class="font-medium">Tambah Departemen</span>
                <span class="ml-2 scale-0 opacity-0 group-hover:scale-100 group-hover:opacity-100 transition-all duration-200 bg-white/20 text-xs font-medium rounded-full py-0.5 px-2">Baru</span>
            </a>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-indigo-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-slate-500">Total Departemen</h3>
                    <div class="mt-1 flex items-baseline">
                        <p class="text-3xl font-semibold text-indigo-600">{{ $stats['total'] }}</p>
                        <p class="ml-2 text-sm text-slate-400">departemen aktif</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full" style="width: 100%"></div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-slate-500">Total Pegawai</h3>
                    <div class="mt-1 flex items-baseline">
                        <p class="text-3xl font-semibold text-purple-600">{{ $stats['employees'] }}</p>
                        <p class="ml-2 text-sm text-slate-400">di semua departemen</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full" style="width: 100%"></div>
            </div>
        </div>
    </div>
    
    <!-- Search and View Toggle -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 mb-8 relative">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input 
                        wire:model.live.debounce.300ms="search" 
                        type="text" 
                        class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        placeholder="Cari departemen berdasarkan nama atau lokasi..."
                    >
                </div>
            </div>
            
            <div class="flex items-center space-x-2">
                <button 
                    wire:click="switchViewMode('grid')" 
                    class="{{ $viewMode === 'grid' ? 'bg-indigo-50 text-indigo-600 border-indigo-200' : 'bg-white text-slate-500 border-slate-200 hover:bg-slate-50' }} p-2 rounded-lg border transition-colors"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
                
                <button 
                    wire:click="switchViewMode('table')" 
                    class="{{ $viewMode === 'table' ? 'bg-indigo-50 text-indigo-600 border-indigo-200' : 'bg-white text-slate-500 border-slate-200 hover:bg-slate-50' }} p-2 rounded-lg border transition-colors"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </button>
                
                <div class="relative">
                    <select 
                        wire:model.live="perPage" 
                        class="appearance-none bg-white border border-slate-200 rounded-lg pl-4 pr-10 py-2 text-sm text-slate-600 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="5">5 per halaman</option>
                        <option value="10">10 per halaman</option>
                        <option value="25">25 per halaman</option>
                        <option value="50">50 per halaman</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Grid View -->
    @if($viewMode === 'grid')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($departements as $dept)
        <div class="relative group bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-200/60 hover:shadow-md transition-all duration-200">
            <!-- Card header with gradient -->
            <div class="h-24 bg-gradient-to-r from-indigo-600 to-purple-600 relative">
                <div class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute bottom-3 left-6 right-6 flex justify-between items-center">
                    <h3 class="text-white font-medium truncate pr-2">{{ $dept->nama_unit }}</h3>
                    <span class="px-2.5 py-1 bg-white/20 backdrop-blur-sm rounded-full text-white text-xs font-medium">
                        {{ $dept->pegawai->count() }} Pegawai
                    </span>
                </div>
            </div>
            
            <!-- Card content -->
            <div class="p-6">
                <div class="flex items-start mb-4">
                    <div class="p-2 bg-indigo-100 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-sm font-medium text-slate-500">Lokasi</h4>
                        <p class="text-sm text-slate-800">{{ $dept->lokasi ?: 'Tidak ada lokasi' }}</p>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-between items-center">
                    <div class="flex items-center">
                        @if($dept->pegawai->isNotEmpty() && $dept->pegawai->first()->foto_profil)
                            <img src="{{ asset('storage/profile-photos/' . $dept->pegawai->first()->foto_profil) }}" class="w-8 h-8 rounded-full object-cover" alt="User">
                            @if($dept->pegawai->count() > 1)
                                <div class="relative -ml-2">
                                    <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-xs font-medium text-white">
                                        +{{ $dept->pegawai->count() - 1 }}
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        <span class="ml-2 text-sm text-slate-600">{{ $dept->pegawai->count() }} anggota</span>
                    </div>
                    
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <a href="{{ route('departement.edit', ['id' => $dept->id]) }}" wire:navigate class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <button wire:click="confirmDelete({{ $dept->id }})" class="p-1.5 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 flex flex-col items-center justify-center bg-white rounded-2xl border border-dashed border-slate-300">
            <div class="rounded-full bg-slate-100 p-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-slate-700">Tidak Ada Departemen</h3>
            <p class="text-slate-500 text-center mb-4">Tambahkan departemen baru untuk memulai</p>
            <a href="{{ route('departement.create') }}" wire:navigate class="flex items-center justify-center px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Departemen Baru
            </a>
        </div>
        @endforelse
    </div>
    @else
    <!-- Table View -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden mb-8">
        @if($departements->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <button wire:click="sortBy('nama_unit')" class="flex items-center focus:outline-none">
                                Nama Unit
                                @if($sortField === 'nama_unit') 
                                    @if($sortDirection === 'asc')
                                        <svg class="ml-1 h-3 w-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg class="ml-1 h-3 w-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <button wire:click="sortBy('lokasi')" class="flex items-center focus:outline-none">
                                Lokasi
                                @if($sortField === 'lokasi') 
                                    @if($sortDirection === 'asc')
                                        <svg class="ml-1 h-3 w-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg class="ml-1 h-3 w-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Jumlah Pegawai</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($departements as $dept)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="shrink-0 h-10 w-10 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-700">
                                    {{ strtoupper(substr($dept->nama_unit, 0, 2)) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-slate-900">{{ $dept->nama_unit }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                            @if($dept->lokasi)
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $dept->lokasi }}
                                </div>
                            @else
                                <span class="text-slate-400 text-sm">Tidak ada lokasi</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                            <div class="flex items-center">
                                <div class="shrink-0 flex -space-x-1">
                                    @foreach($dept->pegawai->take(3) as $employee)
                                        @if($employee->foto_profil)
                                            <img class="h-6 w-6 rounded-full object-cover ring-2 ring-white" src="{{ asset('storage/profile-photos/' . $employee->foto_profil) }}" alt="">
                                        @else
                                            <div class="h-6 w-6 rounded-full bg-slate-300 flex items-center justify-center ring-2 ring-white">
                                                <span class="text-xs text-slate-600 font-medium">{{ strtoupper(substr($employee->nama, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                    
                                    @if($dept->pegawai->count() > 3)
                                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-indigo-100 ring-2 ring-white">
                                            <span class="text-xs text-indigo-700 font-medium">+{{ $dept->pegawai->count() - 3 }}</span>
                                        </div>
                                    @endif
                                </div>
                                <span class="ml-2 text-sm text-slate-500">{{ $dept->pegawai->count() }} pegawai</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('departement.edit', ['id' => $dept->id]) }}" wire:navigate class="p-1.5 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button wire:click="confirmDelete({{ $dept->id }})" class="p-1.5 rounded-lg text-slate-500 hover:text-red-600 hover:bg-red-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="py-12 flex flex-col items-center justify-center">
            <div class="rounded-full bg-slate-100 p-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-slate-700">Tidak Ada Departemen</h3>
            <p class="text-slate-500 text-center mb-4">Tambahkan departemen baru untuk memulai</p>
            <a href="{{ route('departement.create') }}" wire:navigate class="flex items-center justify-center px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Departemen Baru
            </a>
        </div>
        @endif
    </div>
    @endif
    
    <!-- Pagination -->
    @if($departements->hasPages())
    <div class="flex justify-center md:justify-between items-center px-4 py-3 bg-white border border-slate-200/60 rounded-xl shadow-sm">
        <div class="hidden md:block text-sm text-slate-500">
            Menampilkan {{ $departements->firstItem() }} sampai {{ $departements->lastItem() }} dari {{ $departements->total() }} departemen
        </div>
        <div>
            {{ $departements->links() }}
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
                                Hapus Departemen
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-slate-600">
                                    Apakah Anda yakin ingin menghapus departemen ini? 
                                    @if($selectedDepartement && $selectedDepartement->pegawai->count() > 0)
                                    <span class="font-semibold text-red-600">Departemen ini memiliki {{ $selectedDepartement->pegawai->count() }} pegawai.</span> 
                                    Semua data terkait juga akan dihapus. Tindakan ini tidak dapat dibatalkan.
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
                        wire:click="deleteDepartement" 
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
            Livewire.on('swal:modal', param => {
                Swal.fire({
                    title: param.title,
                    text: param.text,
                    icon: param.icon,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4F46E5',
                });
            });
        });
    </script>
</div>
