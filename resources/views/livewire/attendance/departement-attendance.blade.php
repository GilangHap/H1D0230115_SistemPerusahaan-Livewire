<div class="space-y-6">
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-gradient-to-br from-white to-slate-50 rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-blue-100 to-indigo-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-xl font-semibold text-slate-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Absensi Departemen
                </h1>
                <p class="text-slate-500 mt-1 pl-8">Pantau kehadiran staf departemen Anda</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Cari nama/NIP..." 
                        class="pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm w-full md:w-[260px] shadow-sm"
                    />
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                
                <button 
                    wire:click="resetFilters"
                    class="p-2.5 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 border border-slate-200/80 shadow-sm"
                    title="Reset filter"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Section (Enhanced) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-white to-green-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute top-0 right-0 h-32 w-32 bg-gradient-to-bl from-green-100 to-transparent opacity-70 rounded-bl-full -mr-10 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="bg-green-100 p-3 rounded-lg mr-4 relative z-10 group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-slate-800 flex items-baseline">
                    {{ $presentCount }}
                    <span class="text-green-600 text-xs ml-1 font-normal">hadir</span>
                </h3>
                <p class="text-xs text-slate-500 font-medium">Kehadiran</p>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-white to-yellow-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute top-0 right-0 h-32 w-32 bg-gradient-to-bl from-yellow-100 to-transparent opacity-70 rounded-bl-full -mr-10 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="bg-yellow-100 p-3 rounded-lg mr-4 relative z-10 group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-slate-800 flex items-baseline">
                    {{ $lateCount }}
                    <span class="text-yellow-600 text-xs ml-1 font-normal">terlambat</span>
                </h3>
                <p class="text-xs text-slate-500 font-medium">Keterlambatan</p>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-white to-red-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute top-0 right-0 h-32 w-32 bg-gradient-to-bl from-red-100 to-transparent opacity-70 rounded-bl-full -mr-10 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="bg-red-100 p-3 rounded-lg mr-4 relative z-10 group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-slate-800 flex items-baseline">
                    {{ $absentCount }}
                    <span class="text-red-600 text-xs ml-1 font-normal">absen</span>
                </h3>
                <p class="text-xs text-slate-500 font-medium">Ketidakhadiran</p>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm border border-slate-200/60 p-5 flex items-center relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute top-0 right-0 h-32 w-32 bg-gradient-to-bl from-blue-100 to-transparent opacity-70 rounded-bl-full -mr-10 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="bg-blue-100 p-3 rounded-lg mr-4 relative z-10 group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-slate-800 flex items-baseline">
                    {{ $leaveCount }}
                    <span class="text-blue-600 text-xs ml-1 font-normal">hari</span>
                </h3>
                <p class="text-xs text-slate-500 font-medium">Cuti</p>
            </div>
        </div>
    </div>
    
    <!-- Filters Section (Enhanced) -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex flex-wrap items-center gap-3">
                <select 
                    wire:model.live="statusFilter"
                    class="py-2.5 px-4 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm shadow-sm bg-white"
                >
                    <option value="">Semua Status</option>
                    <option value="present">Hadir</option>
                    <option value="late">Terlambat</option>
                    <option value="absent">Tidak Hadir</option>
                    <option value="leave">Cuti</option>
                </select>
                
                <select 
                    wire:model.live="dateFilter"
                    class="py-2.5 px-4 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm shadow-sm bg-white"
                >
                    <option value="today">Hari Ini</option>
                    <option value="yesterday">Kemarin</option>
                    <option value="this_week">Minggu Ini</option>
                    <option value="last_week">Minggu Lalu</option>
                    <option value="this_month">Bulan Ini</option>
                    <option value="last_month">Bulan Lalu</option>
                    <option value="custom">Kustom</option>
                </select>

                @if($dateFilter === 'custom')
                    <div class="flex items-center gap-2 flex-wrap">
                        <input 
                            type="date" 
                            wire:model.live="customDateStart"
                            class="py-2.5 px-4 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm shadow-sm bg-white"
                        >
                        <span class="text-slate-500 text-sm">hingga</span>
                        <input 
                            type="date" 
                            wire:model.live="customDateEnd"
                            class="py-2.5 px-4 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm shadow-sm bg-white"
                        >
                    </div>
                @endif
            </div>
            
            <div class="py-2.5 px-4 text-sm text-slate-600 bg-slate-50 rounded-lg border border-slate-100 shadow-inner flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="font-medium">Periode:</span> 
                <span class="ml-1.5 font-bold text-blue-600">
                    {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}
                    @if($startDate !== $endDate)
                        <span class="mx-1 font-normal text-slate-500">hingga</span>
                        {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Attendance List (Enhanced) -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Pegawai
                            </th>
                            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider cursor-pointer hover:text-blue-600 transition-colors" wire:click="sortBy('tanggal')">
                                <div class="flex items-center">
                                    <span>Tanggal</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        @if ($sortField === 'tanggal')
                                            @if ($sortDirection === 'asc')
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            @endif
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4" />
                                        @endif
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider cursor-pointer hover:text-blue-600 transition-colors" wire:click="sortBy('jam_masuk')">
                                <div class="flex items-center">
                                    <span>Jam Masuk</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        @if ($sortField === 'jam_masuk')
                                            @if ($sortDirection === 'asc')
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            @endif
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4" />
                                        @endif
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider cursor-pointer hover:text-blue-600 transition-colors" wire:click="sortBy('jam_pulang')">
                                <div class="flex items-center">
                                    <span>Jam Keluar</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        @if ($sortField === 'jam_pulang')
                                            @if ($sortDirection === 'asc')
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            @endif
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4" />
                                        @endif
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($attendances as $attendance)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4.5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img 
                                                src="{{ $attendance->pegawai->foto_profil ? Storage::url('profile-photos/' . $attendance->pegawai->foto_profil) : asset('images/default-avatar.svg') }}"
                                                alt="{{ $attendance->pegawai->nama }}" 
                                                class="h-10 w-10 rounded-full object-cover border border-slate-200 shadow-sm"
                                            >
                                        </div>
                                        <div class="ml-3.5">
                                            <p class="text-sm font-semibold text-slate-800">{{ $attendance->pegawai->nama }}</p>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <span class="text-xs text-slate-500">{{ $attendance->pegawai->nip }}</span>
                                                @if($attendance->pegawai->jabatan)
                                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                        {{ $attendance->pegawai->jabatan->nama_jabatan }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4.5">
                                    <div class="text-sm text-slate-700 font-medium">
                                        {{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-slate-400 mt-0.5">
                                        {{ \Carbon\Carbon::parse($attendance->tanggal)->translatedFormat('l') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4.5">
                                    @if($attendance->jam_masuk)
                                        <span class="flex items-center text-sm text-slate-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="font-medium">{{ $attendance->jam_masuk }}</span>
                                            @if($attendance->status === 'terlambat')
                                                <span class="ml-2 inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-100">
                                                    <span class="w-1 h-1 rounded-full bg-yellow-500 mr-1"></span>
                                                    Terlambat
                                                </span>
                                            @endif
                                        </span>
                                    @elseif($attendance->status === 'cuti')
                                        <span class="text-slate-400 text-sm italic">Cuti</span>
                                    @else
                                        <span class="text-slate-400 text-sm italic">--:--</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4.5">
                                    @if($attendance->jam_pulang)
                                        <span class="flex items-center text-sm text-slate-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="font-medium">{{ $attendance->jam_pulang }}</span>
                                        </span>
                                    @elseif($attendance->status === 'cuti')
                                        <span class="text-slate-400 text-sm italic">Cuti</span>
                                    @else
                                        <span class="text-slate-400 text-sm italic">--:--</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4.5">
                                    @if($attendance->status === 'hadir')
                                        <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-green-50 text-green-700 text-xs font-medium border border-green-100 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                            Hadir
                                        </span>
                                    @elseif($attendance->status === 'terlambat')
                                        <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-yellow-50 text-yellow-700 text-xs font-medium border border-yellow-100 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span>
                                            Terlambat
                                        </span>
                                    @elseif($attendance->status === 'tidak_hadir')
                                        <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-red-50 text-red-700 text-xs font-medium border border-red-100 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                            Tidak Hadir
                                        </span>
                                    @elseif($attendance->status === 'cuti')
                                        <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-blue-50 text-blue-700 text-xs font-medium border border-blue-100 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5"></span>
                                            Cuti
                                        </span>
                                    @else
                                        <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-slate-100 text-slate-700 text-xs font-medium border border-slate-200 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500 mr-1.5"></span>
                                            {{ $attendance->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4.5 whitespace-nowrap text-right text-sm font-medium">
                                    <button 
                                        wire:click="showAttendanceDetail('{{ $attendance->id }}')"
                                        class="inline-flex items-center justify-center text-blue-600 hover:text-blue-900 hover:bg-blue-50 p-2 rounded-lg transition-colors border border-transparent hover:border-blue-100"
                                        title="Lihat detail absensi"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500 bg-slate-50/50">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-3 border border-slate-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-slate-600 font-medium text-base">Tidak ada data absensi ditemukan</span>
                                        @if(!empty($search) || !empty($statusFilter) || $dateFilter !== 'today')
                                            <span class="text-sm text-slate-400 mt-1">Coba ubah filter pencarian</span>
                                            <button 
                                                wire:click="resetFilters"
                                                class="mt-4 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors shadow-sm"
                                            >
                                                Reset Filter
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Enhanced Pagination -->
        @if($attendances->hasPages())
            <div class="bg-white border-t border-slate-200 px-4 py-3 sm:px-6">
                {{ $attendances->links() }}
            </div>
        @endif
    </div>

    <!-- Attendance Detail Modal (Enhanced) -->
    @if($showDetailModal && $selectedAttendance)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <!-- Background blur overlay -->
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" wire:click="closeDetailModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-slate-100">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 to-indigo-500"></div>
                    <div class="absolute top-0 right-0 pt-4 pr-4 block">
                        <button 
                            wire:click="closeDetailModal" 
                            class="text-slate-400 hover:text-slate-500 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 p-1.5 rounded-full hover:bg-slate-100"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Employee + attendance info header -->
                    <div class="pt-5 pb-2 px-6 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <h3 class="text-lg font-semibold text-slate-800 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Detail Absensi
                        </h3>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-4 border-t border-blue-100/80 pt-3">
                            <!-- Employee Photo -->
                            <div class="sm:mr-4 mb-2 sm:mb-0">
                                <div class="h-16 w-16 rounded-full border-4 border-white shadow-sm overflow-hidden bg-white">
                                    <img 
                                        src="{{ $selectedAttendance->pegawai->foto_profil ? Storage::url('profile-photos/' . $selectedAttendance->pegawai->foto_profil) : asset('images/default-avatar.svg') }}"
                                        alt="{{ $selectedAttendance->pegawai->nama }}" 
                                        class="h-full w-full object-cover"
                                    >
                                </div>
                            </div>
                            
                            <!-- Employee Info -->
                            <div class="text-center sm:text-left">
                                <h4 class="text-base font-semibold text-slate-800">{{ $selectedAttendance->pegawai->nama }}</h4>
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mt-1">
                                    <span class="text-xs text-slate-500">{{ $selectedAttendance->pegawai->nip }}</span>
                                    @if($selectedAttendance->pegawai->jabatan)
                                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $selectedAttendance->pegawai->jabatan->nama_jabatan }}
                                        </span>
                                    @endif
                                    @if($selectedAttendance->pegawai->unitKerja)
                                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ $selectedAttendance->pegawai->unitKerja->nama_unit }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            <div class="sm:ml-auto mt-2 sm:mt-0">
                                @if($selectedAttendance->status === 'hadir')
                                    <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-green-50 text-green-700 text-xs font-medium border border-green-100 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                        Hadir
                                    </span>
                                @elseif($selectedAttendance->status === 'terlambat')
                                    <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-yellow-50 text-yellow-700 text-xs font-medium border border-yellow-100 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span>
                                        Terlambat
                                    </span>
                                @elseif($selectedAttendance->status === 'tidak_hadir')
                                    <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-red-50 text-red-700 text-xs font-medium border border-red-100 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                        Tidak Hadir
                                    </span>
                                @elseif($selectedAttendance->status === 'cuti')
                                    <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-blue-50 text-blue-700 text-xs font-medium border border-blue-100 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5"></span>
                                        Cuti
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-full bg-slate-100 text-slate-700 text-xs font-medium border border-slate-200 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-500 mr-1.5"></span>
                                        {{ $selectedAttendance->status }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Attendance Details -->
                    <div class="bg-white px-6 pt-5 pb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                            <!-- Date -->
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Tanggal</label>
                                        <p class="text-slate-800 font-medium">{{ \Carbon\Carbon::parse($selectedAttendance->tanggal)->format('d F Y') }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5">{{ \Carbon\Carbon::parse($selectedAttendance->tanggal)->translatedFormat('l') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Check-in Time -->
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Jam Masuk</label>
                                        <p class="text-slate-800 font-medium flex items-center">
                                            @if($selectedAttendance->jam_masuk)
                                                {{ $selectedAttendance->jam_masuk }}
                                                
                                                @if($selectedAttendance->jam_masuk && \Carbon\Carbon::createFromFormat('H:i:s', $selectedAttendance->jam_masuk)->gt(\Carbon\Carbon::createFromFormat('H:i:s', '08:00:00')))
                                                    <span class="ml-2 text-xs inline-flex items-center rounded-full px-2 py-0.5 bg-yellow-50 text-yellow-700 border border-yellow-100">Terlambat</span>
                                                @endif
                                            @elseif($selectedAttendance->status === 'cuti')
                                                <span class="text-slate-400 italic">Cuti</span>
                                            @else
                                                <span class="text-slate-400 italic">--:--</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Check-out Time -->
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Jam Keluar</label>
                                        <p class="text-slate-800 font-medium">
                                            @if($selectedAttendance->jam_pulang)
                                                {{ $selectedAttendance->jam_pulang }}
                                            @elseif($selectedAttendance->status === 'cuti')
                                                <span class="text-slate-400 italic">Cuti</span>
                                            @else
                                                <span class="text-slate-400 italic">--:--</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- If on leave, show leave period -->
                            @if($selectedAttendance->status === 'cuti' && isset($selectedAttendance->leave_start) && isset($selectedAttendance->leave_end))
                                <div class="p-3 bg-blue-50 rounded-lg border border-blue-100">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <label class="text-xs text-blue-700 font-medium block">Periode Cuti</label>
                                            <p class="text-blue-800 font-medium">
                                                {{ \Carbon\Carbon::parse($selectedAttendance->leave_start)->format('d M Y') }} - 
                                                {{ \Carbon\Carbon::parse($selectedAttendance->leave_end)->format('d M Y') }}
                                            </p>
                                            <p class="text-xs text-blue-700 mt-1">
                                                Durasi: {{ $selectedAttendance->leave_days ?? \Carbon\Carbon::parse($selectedAttendance->leave_start)->diffInDays(\Carbon\Carbon::parse($selectedAttendance->leave_end)) + 1 }} hari
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- If there's a reason/note -->
                            @if($selectedAttendance->alasan)
                                <div class="{{ $selectedAttendance->status === 'cuti' ? 'col-span-2' : 'col-span-2' }} p-3 {{ $selectedAttendance->status === 'cuti' ? 'bg-blue-50 border-blue-100' : 'bg-slate-50 border-slate-200' }} rounded-lg border">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $selectedAttendance->status === 'cuti' ? 'text-blue-500' : 'text-slate-500' }} mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        <div>
                                            <label class="text-xs {{ $selectedAttendance->status === 'cuti' ? 'text-blue-700 font-medium' : 'text-slate-500' }} block">
                                                {{ $selectedAttendance->status === 'cuti' ? 'Alasan Cuti' : 'Catatan / Alasan' }}
                                            </label>
                                            <p class="{{ $selectedAttendance->status === 'cuti' ? 'text-blue-800' : 'text-slate-800' }} whitespace-pre-line">
                                                {{ $selectedAttendance->alasan }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- If there's location data -->
                            @if($selectedAttendance->lokasi)
                                <div class="col-span-2 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <div>
                                            <label class="text-xs text-slate-500 block">Lokasi</label>
                                            <p class="text-slate-800">{{ $selectedAttendance->lokasi }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- If there are attendance photos -->
                            @if($selectedAttendance->foto_masuk || $selectedAttendance->foto_keluar)
                                <div class="col-span-2 mt-2">
                                    <h4 class="font-medium text-sm mb-3 text-slate-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Foto Absensi
                                    </h4>
                                    <div class="flex flex-wrap gap-4">
                                        @if($selectedAttendance->foto_masuk)
                                            <div>
                                                <p class="text-xs text-slate-500 mb-1.5 font-medium">Masuk</p>
                                                <img 
                                                    src="{{ Storage::url('attendance-photos/' . $selectedAttendance->foto_masuk) }}" 
                                                    alt="Foto absensi masuk" 
                                                    class="h-28 w-28 object-cover rounded-lg border border-slate-200 shadow-sm hover:opacity-90 transition-opacity cursor-pointer"
                                                    onclick="window.open(this.src, '_blank')"
                                                >
                                            </div>
                                        @endif
                                        
                                        @if($selectedAttendance->foto_keluar)
                                            <div>
                                                <p class="text-xs text-slate-500 mb-1.5 font-medium">Keluar</p>
                                                <img 
                                                    src="{{ Storage::url('attendance-photos/' . $selectedAttendance->foto_keluar) }}" 
                                                    alt="Foto absensi keluar" 
                                                    class="h-28 w-28 object-cover rounded-lg border border-slate-200 shadow-sm hover:opacity-90 transition-opacity cursor-pointer"
                                                    onclick="window.open(this.src, '_blank')"
                                                >
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div class="bg-slate-50 px-6 py-4 sm:px-6 flex justify-end border-t border-slate-200">
                        <button 
                            type="button" 
                            wire:click="closeDetailModal" 
                            class="inline-flex justify-center items-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- JavaScript for Alerts - Enhanced Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('showAlert', event => {
                const type = event.detail[0].type;
                const message = event.detail[0].message;
                
                // Create alert element with enhanced styling
                const alertDiv = document.createElement('div');
                alertDiv.className = `fixed top-4 right-4 z-[60] px-5 py-4 rounded-xl shadow-lg flex items-center opacity-0 transform translate-y-2 transition-all duration-300 ${
                    type === 'success' ? 'bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700' :
                    type === 'error' ? 'bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-700' :
                    'bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500 text-blue-700'
                }`;
                
                const iconSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                iconSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                iconSvg.setAttribute('class', 'h-6 w-6 mr-3');
                iconSvg.setAttribute('fill', 'none');
                iconSvg.setAttribute('viewBox', '0 0 24 24');
                iconSvg.setAttribute('stroke', 'currentColor');
                iconSvg.setAttribute('stroke-width', '2');
                
                const iconPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                iconPath.setAttribute('stroke-linecap', 'round');
                iconPath.setAttribute('stroke-linejoin', 'round');
                
                if (type === 'success') {
                    iconPath.setAttribute('d', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z');
                } else if (type === 'error') {
                    iconPath.setAttribute('d', 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z');
                } else {
                    iconPath.setAttribute('d', 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z');
                }
                
                iconSvg.appendChild(iconPath);
                alertDiv.appendChild(iconSvg);
                
                const contentDiv = document.createElement('div');
                contentDiv.className = 'flex-1';
                
                const titleSpan = document.createElement('h3');
                titleSpan.className = 'font-medium';
                titleSpan.textContent = type === 'success' ? 'Berhasil!' : type === 'error' ? 'Error!' : 'Informasi';
                contentDiv.appendChild(titleSpan);
                
                const messageSpan = document.createElement('div');
                messageSpan.className = 'text-sm mt-0.5';
                messageSpan.textContent = message;
                contentDiv.appendChild(messageSpan);
                
                alertDiv.appendChild(contentDiv);
                
                const closeButton = document.createElement('button');
                closeButton.className = 'ml-4 text-slate-500 hover:text-slate-700 p-1 rounded-full hover:bg-white/50 transition-colors';
                closeButton.onclick = function() {
                    alertDiv.classList.remove('opacity-100');
                    alertDiv.classList.add('opacity-0', 'translate-y-2');
                    setTimeout(() => {
                        if (document.body.contains(alertDiv)) {
                            alertDiv.remove();
                        }
                    }, 300);
                };
                
                const closeSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                closeSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                closeSvg.setAttribute('class', 'h-4 w-4');
                closeSvg.setAttribute('fill', 'none');
                closeSvg.setAttribute('viewBox', '0 0 24 24');
                closeSvg.setAttribute('stroke', 'currentColor');
                closeSvg.setAttribute('stroke-width', '2');
                
                const closePath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                closePath.setAttribute('stroke-linecap', 'round');
                closePath.setAttribute('stroke-linejoin', 'round');
                closePath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
                
                closeSvg.appendChild(closePath);
                closeButton.appendChild(closeSvg);
                alertDiv.appendChild(closeButton);
                
                document.body.appendChild(alertDiv);
                
                // Trigger animation
                setTimeout(() => {
                    alertDiv.classList.remove('opacity-0', 'translate-y-2');
                    alertDiv.classList.add('opacity-100', 'translate-y-0');
                }, 10);
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (document.body.contains(alertDiv)) {
                        alertDiv.classList.remove('opacity-100', 'translate-y-0');
                        alertDiv.classList.add('opacity-0', 'translate-y-2');
                        setTimeout(() => {
                            if (document.body.contains(alertDiv)) {
                                alertDiv.remove();
                            }
                        }, 300);
                    }
                }, 5000);
            });
        });
    </script>
</div>