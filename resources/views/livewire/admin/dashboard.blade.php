<!-- filepath: d:\laragon\www\Sistem-Perusahaan\resources\views\livewire\admin\dashboard.blade.php -->
<div class="space-y-6">
    <!-- Welcome Section with Date -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Welcome back, {{ Auth::user()->nama }}!</h1>
                <p class="text-slate-500 mt-1">Here's what's happening with your organization today.</p>
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Employees -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-md shadow-blue-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Total Employees</h3>
                    <p class="text-white text-3xl font-bold mt-1">{{ $totalPegawai }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>

        <!-- Units/Departments -->
        <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl shadow-md shadow-cyan-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Departments</h3>
                    <p class="text-white text-3xl font-bold mt-1">{{ $totalUnitKerja }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>

        <!-- Positions -->
        <div class="bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl shadow-md shadow-violet-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Job Positions</h3>
                    <p class="text-white text-3xl font-bold mt-1">{{ $totalPositions }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>

        <!-- Pending Leave Requests -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-md shadow-amber-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Pending Leaves</h3>
                    <p class="text-white text-3xl font-bold mt-1">{{ $pendingLeaves }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>
    </div>

    <!-- Salary Overview Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <!-- Total Salary Budget -->
        <div class="bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl shadow-md shadow-emerald-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Monthly Salary Budget</h3>
                    <p class="text-white text-3xl font-bold mt-1">Rp {{ number_format($totalSalaryBudget, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>

        <!-- Average Salary -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-md shadow-indigo-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Average Salary</h3>
                    <p class="text-white text-3xl font-bold mt-1">Rp {{ number_format($averageSalary, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>

        <!-- Highest Paid Department -->
        <div class="bg-gradient-to-br from-rose-500 to-pink-600 rounded-xl shadow-md shadow-rose-500/20 p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-white text-sm font-medium">Highest Paid Department</h3>
                    <p class="text-white text-xl font-bold mt-1 truncate">{{ $highestPaidDept }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            <div class="absolute -right-12 -bottom-12 h-32 w-32 rounded-full bg-white/10"></div>
        </div>
    </div>

    <!-- Middle Section: Charts & Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Today's Attendance -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 lg:col-span-1 hover:shadow-md transition-shadow duration-300">
            <h3 class="text-slate-800 font-semibold mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Today's Attendance
            </h3>
            <div class="flex items-center justify-center h-52">
                <div class="relative w-36 h-36">
                    <!-- Circular Progress Bar using Tailwind classes -->
                    <div class="w-full h-full rounded-full bg-slate-100">
                        <div 
                            class="w-full h-full rounded-full bg-gradient-to-r from-green-500 to-emerald-500"
                            style="clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%); clip: rect(0px, {{ 36 * ($todayAttendance / 100) * 4 }}px, 144px, 0px);"
                        ></div>
                        <div class="absolute top-0 left-0 w-full h-full rounded-full bg-white" style="width: 80%; height: 80%; margin: 10%;"></div>
                    </div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
                        <span class="text-3xl font-bold text-slate-800">{{ $todayAttendance }}%</span>
                        <p class="text-xs text-slate-500 mt-1">Present</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mt-4">
                <div class="text-center p-2 bg-green-50 rounded-lg">
                    <span class="text-sm font-medium text-green-600">Present</span>
                    <p class="text-xl font-semibold text-slate-800">{{ round($todayAttendance * $totalPegawai / 100) }}</p>
                </div>
                <div class="text-center p-2 bg-yellow-50 rounded-lg">
                    <span class="text-sm font-medium text-yellow-600">Late</span>
                    <p class="text-xl font-semibold text-slate-800">{{ round($totalPegawai * 0.05) }}</p>
                </div>
                <div class="text-center p-2 bg-red-50 rounded-lg">
                    <span class="text-sm font-medium text-red-600">Absent</span>
                    <p class="text-xl font-semibold text-slate-800">{{ $totalPegawai - round($todayAttendance * $totalPegawai / 100) - round($totalPegawai * 0.05) }}</p>
                </div>
            </div>
        </div>
        
        <!-- Weekly Attendance Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 lg:col-span-2 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z" clip-rule="evenodd" />
                    </svg>
                    Weekly Attendance
                </h3>
                <div class="flex space-x-2 text-sm">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-green-500 mr-1"></div>
                        <span class="text-slate-600">Present</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-yellow-500 mr-1"></div>
                        <span class="text-slate-600">Late</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-red-500 mr-1"></div>
                        <span class="text-slate-600">Absent</span>
                    </div>
                </div>
            </div>
            
            <div class="h-64">
                <!-- Bar Chart with fixed calculation -->
                <div class="flex h-full items-end space-x-2">
                    @foreach($attendanceStats as $day)
                        @php
                            $total = $day['present'] + $day['late'] + $day['absent'];
                            $presentHeight = $total > 0 ? ($day['present'] / $total) * 100 : 0;
                            $lateHeight = $total > 0 ? ($day['late'] / $total) * 100 : 0;
                            $absentHeight = $total > 0 ? ($day['absent'] / $total) * 100 : 0;
                        @endphp
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-full flex flex-col-reverse items-center justify-end h-[85%]">
                                <div class="w-full flex flex-col items-center space-y-1 h-full">
                                    <!-- Present Bar -->
                                    <div 
                                        class="w-full max-w-[30px] bg-green-500 rounded-t-sm" 
                                        style="height: {{ $presentHeight }}%;"
                                        title="Present: {{ $day['present'] }}"
                                    ></div>
                                    
                                    <!-- Late Bar -->
                                    <div 
                                        class="w-full max-w-[30px] bg-yellow-500" 
                                        style="height: {{ $lateHeight }}%;"
                                        title="Late: {{ $day['late'] }}"
                                    ></div>
                                    
                                    <!-- Absent Bar -->
                                    <div 
                                        class="w-full max-w-[30px] bg-red-500 rounded-b-sm" 
                                        style="height: {{ $absentHeight }}%;"
                                        title="Absent: {{ $day['absent'] }}"
                                    ></div>
                                </div>
                            </div>
                            <div class="text-xs font-medium text-slate-600 mt-2">{{ $day['date'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Salary Distribution by Department -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    Salary Distribution by Department
                </h3>
                <a href="{{ route('salary.report') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">View Full Report</a>
            </div>
            
            <div class="space-y-4">
                @foreach($salaryByDepartment as $dept)
                    <div>
                        <div class="flex justify-between mb-1">
                            <div>
                                <span class="text-sm font-medium text-slate-700">{{ $dept['department'] }}</span>
                                <span class="text-xs text-slate-500 ml-2">({{ $dept['employees'] }} employees)</span>
                            </div>
                            <span class="text-sm font-medium text-slate-700">Rp {{ number_format($dept['total'], 0, ',', '.') }}</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2.5 rounded-full" 
                                style="width: {{ min(100, ($dept['total'] / $totalSalaryBudget) * 100) }}%"></div>
                        </div>
                        <div class="flex justify-end mt-1">
                            <span class="text-xs text-slate-500">
                                Avg: Rp {{ number_format($dept['average'], 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6 pt-4 border-t border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-slate-500">Total Monthly Salary Budget</div>
                    <div class="text-sm font-medium text-slate-800">Rp {{ number_format($totalSalaryBudget, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        
        <!-- Department Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>
                    Department Distribution
                </h3>
                <a href="{{ route('departement.manage') }}" wire:navigate class="text-sm text-blue-600 hover:text-blue-800 font-medium">Manage Units</a>
            </div>
            
            <div class="space-y-4">
                @foreach($departmentStats as $dept)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-slate-700">{{ $dept['name'] }}</span>
                            <span class="text-sm font-medium text-slate-700">{{ $dept['count'] }}</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 h-2.5 rounded-full" style="width: {{ min(100, ($dept['count'] / $totalPegawai) * 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6 pt-4 border-t border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-slate-500">Total Employees</div>
                    <div class="text-sm font-medium text-slate-800">{{ $totalPegawai }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Employees Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-slate-800 font-semibold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                Recently Added Employees
            </h3>
            <a href="{{ route('member') }}" wire:navigate class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All Employees</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($recentUsers as $user)
                <div class="flex items-center p-4 bg-slate-50/70 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="flex-shrink-0">
                        <img 
                            src="{{ $user->foto_profil ? asset('storage/profile-photos/'.$user->foto_profil) : asset('images/default-avatar.svg') }}" 
                            alt="Profile" 
                            class="w-10 h-10 rounded-full object-cover"
                        >
                    </div>
                    <div class="ml-3 flex-1">
                        <div class="font-medium text-slate-900">{{ $user->nama }}</div>
                        <div class="text-xs text-slate-500">{{ $user->jabatan->nama_jabatan ?? 'No Position' }}</div>
                    </div>
                    <div class="text-xs text-slate-400">
                        {{ $user->created_at ? $user->created_at->diffForHumans() : 'N/A' }}
                    </div>
                </div>
            @empty
                <div class="col-span-3 p-4 text-center text-slate-500 bg-slate-50 rounded-lg">
                    No employees found
                </div>
            @endforelse
        </div>
    </div>
</div>