<div class="space-y-6">
    <!-- Hero Section with Date and Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background elements -->
        <div class="absolute -top-14 -right-14 w-28 h-28 bg-emerald-50 rounded-full opacity-70"></div>
        <div class="absolute -bottom-14 -left-14 w-28 h-28 bg-emerald-50 rounded-full opacity-70"></div>
        
        <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4 relative z-10">
            <div class="space-y-2">
                <h1 class="text-2xl font-bold text-slate-800">Selamat datang, {{ Auth::user()->nama }}</h1>
                <p class="text-slate-500">Pantau kehadiran tim dan kelola departemen Anda dengan efektif.</p>
                <div class="flex items-center text-sm text-emerald-600 font-medium mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $currentDate }}
                </div>
            </div>
            
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('attendance.departement') }}" wire:navigate class="flex items-center px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span class="font-medium">Absensi Tim</span>
                </a>
                <a href="{{ route('leave.approve') }}" wire:navigate class="flex items-center px-4 py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Kelola Cuti</span>
                </a>
                <a href="{{ route('report.departement-salary') }}" wire:navigate class="flex items-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="font-medium">Laporan Gaji</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Team Size -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 relative overflow-hidden hover:shadow-md transition-shadow group">
            <div class="flex items-start justify-between">
                <div class="flex-shrink-0 bg-emerald-50 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-slate-800">{{ $todayAttendance['total'] }}</p>
                    <p class="text-sm font-medium text-slate-500 mt-1">Anggota Tim</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-emerald-500"></div>
            <div class="absolute -right-6 bottom-0 h-32 w-32 bg-gradient-to-t from-emerald-50 to-transparent opacity-50 rounded-full"></div>
            <a href="{{ route('departement.members', ['id' => auth()->user()->unit_kerja_id ?? 1]) }}" wire:navigate class="absolute inset-0 z-10"></a>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 relative overflow-hidden hover:shadow-md transition-shadow group">
            <div class="flex items-start justify-between">
                <div class="flex-shrink-0 bg-amber-50 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-slate-800">{{ count($pendingApprovals) }}</p>
                    <p class="text-sm font-medium text-slate-500 mt-1">Persetujuan Tertunda</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-amber-500"></div>
            <div class="absolute -right-6 bottom-0 h-32 w-32 bg-gradient-to-t from-amber-50 to-transparent opacity-50 rounded-full"></div>
            <a href="{{ route('leave.approve') }}" wire:navigate class="absolute inset-0 z-10"></a>
        </div>

        <!-- Present Today -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 relative overflow-hidden hover:shadow-md transition-shadow group">
            <div class="flex items-start justify-between">
                <div class="flex-shrink-0 bg-green-50 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-slate-800">{{ $todayAttendance['present'] }}</p>
                    <p class="text-sm font-medium text-slate-500 mt-1">Hadir Hari Ini</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-green-500"></div>
            <div class="absolute -right-6 bottom-0 h-32 w-32 bg-gradient-to-t from-green-50 to-transparent opacity-50 rounded-full"></div>
            <a href="{{ route('attendance.departement') }}" wire:navigate class="absolute inset-0 z-10"></a>
        </div>

        <!-- Absent Today -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-5 relative overflow-hidden hover:shadow-md transition-shadow group">
            <div class="flex items-start justify-between">
                <div class="flex-shrink-0 bg-red-50 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-slate-800">{{ $todayAttendance['absent'] }}</p>
                    <p class="text-sm font-medium text-slate-500 mt-1">Tidak Hadir</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-red-500"></div>
            <div class="absolute -right-6 bottom-0 h-32 w-32 bg-gradient-to-t from-red-50 to-transparent opacity-50 rounded-full"></div>
            <a href="{{ route('attendance.departement') }}" wire:navigate class="absolute inset-0 z-10"></a>
        </div>
    </div>

    <!-- Middle Section: Team Attendance & Leave Requests -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Today's Team Attendance -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 lg:col-span-1 hover:shadow-md transition-shadow duration-300">
            <h3 class="text-slate-800 font-semibold mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Kehadiran Tim Hari Ini
            </h3>
            
            <div class="flex items-center justify-center mb-6">
                <div class="relative w-40 h-40">
                    <!-- Circular Progress Bar for Present -->
                    <svg viewBox="0 0 36 36" class="w-full h-full">
                        <!-- Background Circle -->
                        <path class="stroke-current text-slate-100" stroke-width="3.8" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        <!-- Progress Circle -->
                        <path 
                            class="stroke-current text-emerald-500" 
                            stroke-width="3.8" 
                            stroke-linecap="round" 
                            fill="none" 
                            stroke-dasharray="{{ $todayAttendance['presentPercent'] }}, 100"
                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                        <!-- Late Progress Circle (Layered) -->
                        <path 
                            class="stroke-current text-amber-400" 
                            stroke-width="3.8" 
                            stroke-linecap="round" 
                            fill="none" 
                            stroke-dasharray="{{ $todayAttendance['latePercent'] }}, 100"
                            stroke-dashoffset="{{ -$todayAttendance['presentPercent'] }}"
                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                    </svg>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
                        <span class="text-3xl font-bold text-slate-800">{{ $todayAttendance['presentPercent'] + $todayAttendance['latePercent'] }}%</span>
                        <p class="text-xs text-slate-500 mt-1">Kehadiran</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-3 gap-3">
                <div class="text-center p-3 bg-emerald-50 rounded-lg">
                    <span class="text-sm font-medium text-emerald-600">Hadir</span>
                    <p class="text-xl font-semibold text-slate-800">{{ $todayAttendance['present'] }}</p>
                </div>
                <div class="text-center p-3 bg-amber-50 rounded-lg">
                    <span class="text-sm font-medium text-amber-600">Terlambat</span>
                    <p class="text-xl font-semibold text-slate-800">{{ $todayAttendance['late'] }}</p>
                </div>
                <div class="text-center p-3 bg-red-50 rounded-lg">
                    <span class="text-sm font-medium text-red-600">Absen</span>
                    <p class="text-xl font-semibold text-slate-800">{{ $todayAttendance['absent'] }}</p>
                </div>
            </div>
            
            <div class="mt-4 pt-3 border-t border-slate-100">
                <a href="{{ route('attendance.departement') }}" wire:navigate class="flex items-center justify-center text-sm text-emerald-600 hover:text-emerald-800 font-medium transition-colors">
                    <span>Lihat detail absensi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Recent Leave Requests -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 lg:col-span-2 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Riwayat Pengajuan Cuti
                </h3>
                <a href="{{ route('leave.approve') }}" wire:navigate class="text-sm text-slate-600 hover:text-purple-600 font-medium flex items-center">
                    <span>Lihat Semua</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            
            <div class="space-y-3">
                @forelse($recentLeaveRequests as $request)
                    <div class="flex items-center p-3 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center
                                @if($request->status === 'approved') bg-green-100 text-green-600
                                @elseif($request->status === 'rejected') bg-red-100 text-red-600
                                @elseif($request->status === 'pending') bg-amber-100 text-amber-600
                                @else bg-slate-100 text-slate-600 @endif
                            ">
                                @if($request->status === 'approved')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif($request->status === 'rejected')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @elseif($request->status === 'pending')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-medium text-slate-800">{{ $request->pegawai->nama ?? 'N/A' }}</div>
                                <div>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if($request->status === 'approved') bg-green-100 text-green-700
                                        @elseif($request->status === 'rejected') bg-red-100 text-red-700
                                        @elseif($request->status === 'pending') bg-amber-100 text-amber-700
                                        @else bg-slate-100 text-slate-700 @endif
                                    ">
                                        @if($request->status === 'approved') Disetujui
                                        @elseif($request->status === 'rejected') Ditolak
                                        @elseif($request->status === 'pending') Menunggu
                                        @else {{ ucfirst($request->status) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center text-xs text-slate-500 mt-1">
                                <span>{{ \Carbon\Carbon::parse($request->tanggal_mulai)->format('d M Y') }}</span>
                                <span class="mx-1">-</span>
                                <span>{{ \Carbon\Carbon::parse($request->tanggal_akhir)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-slate-500 bg-slate-50 rounded-lg">
                        Tidak ada pengajuan cuti terbaru
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Bottom Section: Team Members & Pending Approvals -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Team Members -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Anggota Tim
                </h3>
                <a href="{{ route('departement.members', ['id' => auth()->user()->unit_kerja_id ?? 1]) }}" wire:navigate class="text-sm text-slate-600 hover:text-emerald-600 font-medium flex items-center transition-colors">
                    <span>Lihat Semua</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            
            <div class="space-y-3">
                @forelse($teamMembers as $member)
                    <div class="flex items-center p-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                        <div class="flex-shrink-0">
                            <img 
                                src="{{ $member->foto_profil ? asset('storage/profile-photos/'.$member->foto_profil) : asset('images/default-avatar.svg') }}" 
                                alt="{{ $member->nama }}" 
                                class="w-10 h-10 rounded-full object-cover border border-slate-200"
                            >
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="font-medium text-slate-800">{{ $member->nama }}</div>
                            <div class="flex items-center">
                                <span class="text-xs text-slate-500">{{ $member->nip }}</span>
                                @if($member->jabatan)
                                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 mx-2">
                                        {{ $member->jabatan->nama_jabatan }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-slate-500 bg-slate-50 rounded-lg">
                        Tidak ada anggota tim dalam departemen ini
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Pending Approvals -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Persetujuan Cuti Tertunda
                </h3>
                <a href="{{ route('leave.approve') }}" wire:navigate class="text-sm text-slate-600 hover:text-amber-600 font-medium flex items-center transition-colors">
                    <span>Lihat Semua</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            
            <div class="space-y-3">
                @forelse($pendingApprovals as $approval)
                    <div class="p-3 bg-slate-50 rounded-lg hover:bg-amber-50/40 transition-colors">
                        <div class="flex items-center mb-2">
                            <div class="flex-shrink-0">
                                <img 
                                    src="{{ $approval->pegawai && $approval->pegawai->foto_profil ? asset('storage/profile-photos/'.$approval->pegawai->foto_profil) : asset('images/default-avatar.svg') }}" 
                                    alt="{{ $approval->pegawai ? $approval->pegawai->nama : 'N/A' }}" 
                                    class="w-8 h-8 rounded-full object-cover border border-slate-200"
                                >
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="flex items-center gap-1">
                                    <span class="font-medium text-slate-800">{{ $approval->pegawai ? $approval->pegawai->nama : 'N/A' }}</span>
                                    <span class="text-xs text-slate-500">({{ $approval->pegawai ? $approval->pegawai->nip : 'N/A' }})</span>
                                </div>
                                @if(isset($approval->jenis_cuti))
                                <span class="text-xs inline-flex items-center px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">
                                    {{ $approval->jenis_cuti }}
                                </span>
                                @endif
                            </div>
                            <div class="text-xs text-slate-400">
                                {{ $approval->created_at ? $approval->created_at->diffForHumans() : 'N/A' }}
                            </div>
                        </div>
                        
                        <div class="bg-white border border-slate-200 rounded-lg p-2.5 text-sm">
                            <p class="text-slate-700">{{ Str::limit($approval->alasan ?? 'Tidak ada alasan', 100) }}</p>
                            <div class="flex items-center mt-1.5 text-xs text-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $approval->tanggal_mulai ? \Carbon\Carbon::parse($approval->tanggal_mulai)->format('d M Y') : 'N/A' }}</span>
                                <span class="mx-1">-</span>
                                <span>{{ $approval->tanggal_akhir ? \Carbon\Carbon::parse($approval->tanggal_akhir)->format('d M Y') : 'N/A' }}</span>
                                
                                @if($approval->tanggal_mulai && $approval->tanggal_akhir)
                                    <span class="ml-1 text-amber-600 font-medium">
                                        ({{ \Carbon\Carbon::parse($approval->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($approval->tanggal_akhir)) + 1 }} hari)
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex gap-2 mt-3">
                            <button 
                                wire:click="approveCuti({{ $approval->id }})"
                                class="flex-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-sm font-medium py-1.5 rounded-md transition-colors flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Setuju
                            </button>
                            <button 
                                wire:click="rejectCuti({{ $approval->id }})"
                                class="flex-1 bg-red-50 hover:bg-red-100 text-red-700 text-sm font-medium py-1.5 rounded-md transition-colors flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Tolak
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="p-5 text-center text-slate-500 bg-slate-50 rounded-lg">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <span>Tidak ada persetujuan cuti yang tertunda</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Alert Script -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showAlert', ({type, message}) => {
                Swal.fire({
                    icon: type,
                    title: type === 'success' ? 'Berhasil' : 'Perhatian',
                    text: message,
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });
    </script>
</div>