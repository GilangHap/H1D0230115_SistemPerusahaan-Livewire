<div class="space-y-6">
    <!-- Welcome Section with Date -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Welcome back, {{ Auth::user()->nama }}!</h1>
                <p class="text-slate-500 mt-1">Track your attendance and leave information.</p>
            </div>
            <div class="flex items-center bg-blue-50/50 px-4 py-2 rounded-lg border border-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-blue-800 font-medium">{{ $currentDate }}</span>
            </div>
        </div>
    </div>
    
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <!-- Attendance Rate -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-md shadow-blue-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">{{ $attendanceSummary['currentMonth'] }} Attendance</h3>
                    <p class="text-white text-3xl font-bold mt-1">{{ $attendanceSummary['attendanceRate'] }}%</p>
                    <div class="text-blue-100 text-xs mt-2">
                        <span class="inline-block mr-3">
                            <span class="bg-white/20 rounded-full w-2 h-2 inline-block mr-1"></span>
                            On time: {{ $attendanceSummary['onTime'] }}
                        </span>
                        <span class="inline-block">
                            <span class="bg-amber-300/60 rounded-full w-2 h-2 inline-block mr-1"></span>
                            Late: {{ $attendanceSummary['late'] }}
                        </span>
                    </div>
                    <div class="text-blue-100 text-xs mt-1">
                        <span class="bg-red-300/60 rounded-full w-2 h-2 inline-block mr-1"></span>
                        Absent: {{ $attendanceSummary['absent'] }}
                    </div>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>

        <!-- Leave Balance -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-md shadow-indigo-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Leave Balance</h3>
                    <p class="text-white text-3xl font-bold mt-1">{{ $leaveBalance['remaining'] }} days</p>
                    <div class="text-indigo-100 text-xs mt-2">
                        <span class="inline-block mr-3">
                            <span class="bg-white/20 rounded-full w-2 h-2 inline-block mr-1"></span>
                            Used: {{ $leaveBalance['used'] }}
                        </span>
                        <span class="inline-block">
                            <span class="bg-amber-300/60 rounded-full w-2 h-2 inline-block mr-1"></span>
                            Pending: {{ $leaveBalance['pending'] }}
                        </span>
                    </div>
                    <div class="text-indigo-100 text-xs mt-1">
                        <span class="bg-green-300/60 rounded-full w-2 h-2 inline-block mr-1"></span>
                        Total: {{ $leaveBalance['total'] }}
                    </div>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>

        <!-- Today's Status -->
        <div class="bg-gradient-to-br 
            @if($todayAttendance && $todayAttendance->status == 'hadir')
                from-teal-500 to-teal-600
            @elseif($todayAttendance && $todayAttendance->status == 'terlambat')
                from-amber-500 to-amber-600
            @elseif($todayAttendance)
                from-red-500 to-red-600
            @else
                from-slate-500 to-slate-600
            @endif
            rounded-xl shadow-md 
            @if($todayAttendance && $todayAttendance->status == 'hadir')
                shadow-teal-500/20
            @elseif($todayAttendance && $todayAttendance->status == 'terlambat')
                shadow-amber-500/20
            @elseif($todayAttendance)
                shadow-red-500/20
            @else
                shadow-slate-500/20
            @endif
            p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Today's Status</h3>
                    @php
                        $status = $todayAttendance ? ucfirst($todayAttendance->status) : 'Not Recorded';
                        $checkinTime = $todayAttendance ? $todayAttendance->jam_masuk : '--:--';
                    @endphp
                    <p class="text-white text-xl font-bold mt-1">{{ $status }}</p>
                    <div class="text-white/80 text-sm mt-2">
                        @if($todayAttendance)
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Check-in at: {{ $checkinTime }}
                            </div>
                            @if($todayAttendance->jam_pulang)
                            <div class="flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Check-out at: {{ $todayAttendance->jam_pulang }}
                            </div>
                            @endif
                        @else
                            <span class="inline-block mt-1">
                                Record your attendance
                            </span>
                        @endif
                    </div>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    @if($todayAttendance && $todayAttendance->status == 'hadir')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @elseif($todayAttendance && $todayAttendance->status == 'terlambat')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @elseif($todayAttendance)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    @endif
                </div>
            </div>
            
            @if($todayAttendance && $todayAttendance->status == 'terlambat')
                <div class="absolute bottom-0 left-0 right-0 bg-white/20 py-2 px-3 mt-3">
                    <div class="text-white text-xs flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Late after 08:00 AM
                    </div>
                </div>
            @endif
            
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>
    </div>

    <!-- Middle Section: Leave Balance & Weekly Performance -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Leave Balance Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 lg:col-span-1 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
            <div class="absolute -bottom-16 -right-16 w-32 h-32 bg-gradient-to-tl from-indigo-50 to-purple-50 rounded-full opacity-70"></div>
            
            <div class="relative z-10">
                <h3 class="text-slate-800 font-semibold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                    Annual Leave Status
                </h3>
                
                <div class="flex items-center justify-center mb-6">
                    <div class="relative w-40 h-40">
                        <!-- Circular Progress Bar for Leave Used -->
                        <svg viewBox="0 0 36 36" class="w-full h-full">
                            <!-- Background Circle -->
                            <path class="stroke-current text-slate-100" stroke-width="3.8" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <!-- Progress Circle -->
                            <path 
                                class="stroke-current text-indigo-500" 
                                stroke-width="3.8" 
                                stroke-linecap="round" 
                                fill="none" 
                                stroke-dasharray="{{ $leaveBalance['percentUsed'] }}, 100"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                            />
                            <!-- Pending Circle (as a second layer) -->
                            <path 
                                class="stroke-current text-amber-400" 
                                stroke-width="3.8" 
                                stroke-linecap="round" 
                                fill="none" 
                                stroke-dasharray="{{ min(($leaveBalance['pending'] / $leaveBalance['total']) * 100, 100 - $leaveBalance['percentUsed']) }}, 100"
                                stroke-dashoffset="{{ -$leaveBalance['percentUsed'] }}"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                            />
                        </svg>
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
                            <span class="text-3xl font-bold text-slate-800">{{ $leaveBalance['remaining'] }}</span>
                            <p class="text-xs text-slate-500 mt-1">Days Left</p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-2">
                    <div class="text-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                        <span class="text-sm font-medium text-slate-600">Total</span>
                        <p class="text-xl font-semibold text-slate-800">{{ $leaveBalance['total'] }}</p>
                    </div>
                    <div class="text-center p-3 bg-indigo-50 rounded-lg border border-indigo-100">
                        <span class="text-sm font-medium text-indigo-600">Used</span>
                        <p class="text-xl font-semibold text-slate-800">{{ $leaveBalance['used'] }}</p>
                    </div>
                    <div class="text-center p-3 bg-amber-50 rounded-lg border border-amber-100">
                        <span class="text-sm font-medium text-amber-600">Pending</span>
                        <p class="text-xl font-semibold text-slate-800">{{ $leaveBalance['pending'] }}</p>
                    </div>
                </div>
                
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('leave.apply') }}" class="flex-1 text-center py-2.5 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm font-medium flex items-center justify-center shadow-sm hover:shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Request Leave
                    </a>
                    <a href="{{ route('leave.history') }}" class="flex-1 text-center py-2.5 px-4 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-colors text-sm font-medium flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        History
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Weekly Performance Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 lg:col-span-2 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z" clip-rule="evenodd" />
                    </svg>
                    Weekly Attendance Performance
                </h3>
                <div class="text-sm text-slate-500">
                    Last 7 days
                </div>
            </div>
            
            <div class="h-64">
                <!-- Simple Line Chart created with HTML/CSS -->
                <div class="flex h-full items-end space-x-2">
                    @foreach($weeklyPerformance as $day)
                        <div class="flex-1 flex flex-col items-center">
                            <div class="relative w-full flex items-end justify-center h-[80%]">
                                <div class="absolute bottom-0 left-0 right-0 border-b border-slate-200"></div>
                                <div 
                                    class="w-full max-w-[30px] 
                                    @if($day['status'] == 'ontime')
                                        bg-gradient-to-t from-teal-500 to-teal-300
                                    @elseif($day['status'] == 'late')
                                        bg-gradient-to-t from-amber-500 to-amber-300
                                    @elseif($day['status'] == 'weekend')
                                        bg-gradient-to-t from-blue-400 to-blue-200
                                    @elseif($day['status'] == 'upcoming')
                                        bg-gradient-to-t from-slate-300 to-slate-200
                                    @else
                                        bg-gradient-to-t from-slate-400 to-slate-300
                                    @endif
                                    rounded-t-sm 
                                    @if($day['isToday'])
                                        ring-2 ring-blue-500 ring-offset-2
                                    @endif" 
                                    style="height: {{ $day['value'] }}%;"
                                    title="{{ $day['day'] }}: {{ $day['value'] }}%"
                                ></div>
                            </div>
                            <div class="text-xs font-medium 
                                @if($day['isToday'])
                                    text-blue-600
                                @else
                                    text-slate-600
                                @endif 
                                mt-2">{{ $day['day'] }}</div>
                            <div class="text-xs text-slate-400">{{ $day['date'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="flex items-center justify-center mt-4 text-xs text-slate-500 space-x-4">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-teal-400 rounded-sm inline-block mr-1"></span>
                    On time
                </div>
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-amber-400 rounded-sm inline-block mr-1"></span>
                    Late
                </div>
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-blue-400 rounded-sm inline-block mr-1"></span>
                    Weekend
                </div>
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-slate-400 rounded-sm inline-block mr-1"></span>
                    Absent/Upcoming
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Profile Info & Recent Attendance -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Profile Information -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Your Profile
                </h3>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Edit Profile</a>
            </div>
            
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-6">
                <div class="w-24 h-24 rounded-full bg-slate-200 flex items-center justify-center overflow-hidden border-4 border-slate-50 ring-2 ring-slate-200">
                    @if($pegawaiData->foto_profil)
                        <img src="{{ Storage::url('profile-photos/' . $pegawaiData->foto_profil) }}" alt="{{ $pegawaiData->nama }}" class="w-full h-full object-cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </div>
                
                <div class="flex-1 text-center md:text-left">
                    <h4 class="text-xl font-medium text-slate-800">{{ $pegawaiData->nama }}</h4>
                    <p class="text-slate-500">{{ $pegawaiData->jabatan->nama_jabatan ?? 'Staff' }}</p>
                    
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <span class="text-sm text-slate-500">Employee ID</span>
                            <p class="font-medium text-slate-800">{{ $pegawaiData->id }}</p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <span class="text-sm text-slate-500">Department</span>
                            <p class="font-medium text-slate-800">{{ $pegawaiData->unitkerja->nama_unit ?? 'Not Assigned' }}</p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <span class="text-sm text-slate-500">Email</span>
                            <p class="font-medium text-slate-800">{{ $pegawaiData->email }}</p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <span class="text-sm text-slate-500">Join Date</span>
                            <p class="font-medium text-slate-800">{{ $pegawaiData->tanggal_bergabung ? \Carbon\Carbon::parse($pegawaiData->tanggal_bergabung)->format('d M Y') : 'Not Set' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Attendance -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                    Recent Attendance
                </h3>
                <a href="#" class="text-sm text-teal-600 hover:text-teal-800 font-medium">View History</a>
            </div>
            
            <div class="space-y-3">
                @forelse($recentAttendance as $attendance)
                    <div class="flex items-center p-3 bg-slate-50/70 rounded-lg hover:bg-slate-50 transition-colors">
                        <div class="h-10 w-10 rounded-full flex items-center justify-center 
                            @if($attendance->status == 'hadir') bg-teal-100 text-teal-600
                            @elseif($attendance->status == 'terlambat') bg-amber-100 text-amber-600 
                            @else bg-red-100 text-red-600
                            @endif">
                            @if($attendance->status == 'hadir')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @elseif($attendance->status == 'terlambat')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @endif
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="font-medium 
                                @if($attendance->status == 'hadir') text-teal-600
                                @elseif($attendance->status == 'terlambat') text-amber-600
                                @else text-red-600
                                @endif">
                                {{ ucfirst($attendance->status) }}
                            </div>
                            <div class="text-sm text-slate-500">{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }}
                                @if(\Carbon\Carbon::parse($attendance->tanggal)->isToday())
                                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-0.5 rounded-full ml-1">Today</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-medium text-slate-700">
                                {{ $attendance->jam_masuk ? $attendance->jam_masuk : '--:--' }}
                            </div>
                            <div class="text-xs text-slate-500">
                                Clock In
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-slate-500 bg-slate-50 rounded-lg">
                        No attendance records found
                    </div>
                @endforelse
            </div>
            
            <div class="mt-4">
                @php
                    $todayRecorded = $recentAttendance->contains(function($attendance) {
                        return \Carbon\Carbon::parse($attendance->tanggal)->isToday();
                    });
                @endphp
                <div class="flex gap-2">
                    @if ($todayRecorded)
                        <button disabled class="flex-1 py-2 px-4 bg-slate-100 text-slate-500 cursor-not-allowed rounded-lg transition-colors text-sm font-medium flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Attendance Recorded
                        </button>
                    @else
                        <a href="{{ route('attendance.check') }}" class="flex-1 py-2 px-4 bg-teal-600 text-white hover:bg-teal-700 rounded-lg transition-colors text-sm font-medium flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Record Attendance
                        </a>
                    @endif
                    <a href="{{ route('leave.apply') }}" class="flex-1 py-2 px-4 bg-indigo-100 text-indigo-700 hover:bg-indigo-200 rounded-lg transition-colors text-sm font-medium flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Request Leave
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Additional notification for being late -->
    @if($todayAttendance && $todayAttendance->status == 'terlambat')
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-5">
            <div class="flex items-start">
                <div class="flex-shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-amber-800 font-medium">You were late today</h3>
                    <p class="text-amber-700 mt-1 text-sm">Your attendance has been recorded as late because you checked in after 08:00 AM. Please try to arrive on time for future shifts.</p>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                            Check-in time: {{ $todayAttendance->jam_masuk }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 ml-2">
                            Limit: 08:00:00
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>