<div class="h-screen w-64 bg-white border-r border-gray-100 shadow-sm flex flex-col">
    <!-- Profile Section -->
    <div class="flex flex-col items-center pt-8 pb-6">
        <div class="relative group">
            <img 
                src="{{ Auth::user()->profile_photo ?? asset('images/default-avatar.png') }}" 
                alt="Profile Picture" 
                class="w-20 h-20 rounded-full object-cover ring-2 ring-indigo-100"
            >
            <a href="" class="absolute bottom-0 right-0 bg-indigo-600 text-white p-1.5 rounded-full shadow-lg transform transition-transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </div>
        <h2 class="mt-4 font-medium text-gray-800">{{ Auth::user()->name }}</h2>
        <span class="text-sm text-gray-500">{{ Auth::user()->position ?? 'Staff' }}</span>
    </div>
    
    <!-- Divider -->
    <div class="px-6">
        <div class="h-px bg-gray-200"></div>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 pt-6 px-4 pb-4 space-y-1 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('staff.dashboard') }}" 
           class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.dashboard') ? 'bg-indigo-50 text-indigo-700' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ Request::routeIs('staff.dashboard') ? 'text-indigo-600' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="ml-3 font-medium text-sm">Dashboard</span>
        </a>
        
        <!-- Attendance Group -->
        <div x-data="{ open: {{ Request::routeIs('staff.attendance*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.attendance*') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ Request::routeIs('staff.attendance*') ? 'text-indigo-600' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-3 font-medium text-sm flex-1 text-left">🕒 Absensi</span>
                <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            
            <div x-show="open" class="pl-10 pr-3 space-y-1 mt-1" x-transition>
                <a href="" 
                   class="flex items-center px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.attendance.checkin') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <span class="mr-2">•</span>
                    <span>Check-in/out Harian</span>
                </a>
                <a href="" 
                   class="flex items-center px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.attendance.history') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <span class="mr-2">•</span>
                    <span>Riwayat Absensi</span>
                </a>
            </div>
        </div>
        
        <!-- Leave Group -->
        <div x-data="{ open: {{ Request::routeIs('staff.leaves*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.leaves*') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ Request::routeIs('staff.leaves*') ? 'text-indigo-600' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="ml-3 font-medium text-sm flex-1 text-left">📅 Cuti</span>
                <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            
            <div x-show="open" class="pl-10 pr-3 space-y-1 mt-1" x-transition>
                <a href="" 
                   class="flex items-center px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.leaves.create') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <span class="mr-2">•</span>
                    <span>Ajukan Cuti</span>
                </a>
                <a href="" 
                   class="flex items-center px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.leaves.quota') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <span class="mr-2">•</span>
                    <span>Sisa Kuota Cuti</span>
                </a>
            </div>
        </div>
        
        <!-- Profile Group -->
        <div x-data="{ open: {{ Request::routeIs('staff.profile*') || Request::routeIs('staff.payslips*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.profile*') || Request::routeIs('staff.payslips*') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ Request::routeIs('staff.profile*') || Request::routeIs('staff.payslips*') ? 'text-indigo-600' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="ml-3 font-medium text-sm flex-1 text-left">👤 Profil</span>
                <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            
            <div x-show="open" class="pl-10 pr-3 space-y-1 mt-1" x-transition>
                <a href="" 
                   class="flex items-center px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.profile.edit') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <span class="mr-2">•</span>
                    <span>Edit Data Pribadi</span>
                </a>
                <a href="" 
                   class="flex items-center px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.profile.photo') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <span class="mr-2">•</span>
                    <span>Upload Foto Profil</span>
                </a>
                <a href="" 
                   class="flex items-center px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-indigo-50 transition-colors {{ Request::routeIs('staff.payslips*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <span class="mr-2">•</span>
                    <span>Slip Gaji</span>
                </a>
            </div>
        </div>
    </nav>
    
    <!-- Footer -->
    <div class="px-4 pb-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>