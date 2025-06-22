<div 
    class="h-screen w-72 bg-gradient-to-br from-violet-900 to-indigo-800 border-r border-violet-700/30 shadow-xl flex flex-col fixed transition-transform duration-300 ease-in-out"
    x-data="{ activeMenu: @entangle('activeMenu') }"
    wire:ignore.self
>
    <!-- Logo and Title Section -->
    <div class="flex flex-col items-center pt-8 pb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="h-10 w-10 bg-gradient-to-tr from-violet-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-600/20 animate-pulse-slow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-indigo-400">
                Staff Portal
            </h1>
        </div>
        <div class="relative group">
            <img 
                src="{{ Auth::user()->foto_profil 
                        ? Storage::url('profile-photos/' . Auth::user()->foto_profil) 
                        : asset('images/default-avatar.svg') }}" 
                alt="Profile Picture" 
                class="w-20 h-20 rounded-full object-cover ring-2 ring-violet-500/50 shadow-md shadow-violet-500/10 hover:ring-violet-400 transition-all duration-300"
            >
            <a href="{{ route('profile') }}" class="absolute bottom-0 right-0 bg-gradient-to-r from-violet-600 to-indigo-500 text-white p-1.5 rounded-full shadow-lg transform transition-transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </div>
        <h2 class="mt-4 font-medium text-white">{{ Auth::user()->nama }}</h2>
        <span class="text-sm text-slate-300">{{ Auth::user()->jabatan->nama_jabatan ?? 'Staff' }}</span>
        <div class="mt-2 px-3 py-1 rounded-full bg-violet-500/20 text-xs text-violet-300 border border-violet-500/30">
            Online
        </div>
    </div>
    
    <!-- Divider with enhanced styling -->
    <div class="px-6">
        <div class="h-px bg-gradient-to-r from-transparent via-slate-400/20 to-transparent"></div>
    </div>
    
    <!-- Navigation with Livewire integration -->
    <nav class="flex-1 pt-6 px-4 pb-4 space-y-2 overflow-y-auto scrollbar-hide">
        <!-- Dashboard -->
        <a href="{{ route('staff.dashboard') }}" 
        wire:navigate
           wire:click="setActiveMenu('dashboard')"
           class="flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-violet-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('staff.dashboard') ? 'bg-gradient-to-r from-violet-600/40 to-indigo-500/40 shadow-md text-white font-medium' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('staff.dashboard') ? 'text-violet-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span class="font-medium text-sm">Dashboard</span>
        </a>
        
        <!-- Attendance -->
        <div x-data="{ open: '{{ Request::routeIs('attendance*') ? 'true' : 'false' }}' === 'true' }">
            <button 
                @click="open = !open" 
                wire:click="toggleMenu('attendance')"
                class="w-full flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-violet-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('attendance*') ? 'bg-gradient-to-r from-violet-600/40 to-indigo-500/40 shadow-md text-white font-medium' : '' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('attendance*') ? 'text-violet-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-sm flex-1 text-left">Absensi</span>
                <svg 
                    class="w-4 h-4 transition-transform duration-300" 
                    :class="{'rotate-180': open}" 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            
            <div 
                x-show="open" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150" 
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="pl-12 pr-3 space-y-1 mt-1"
            >
                <a href="{{ route('attendance.check') }}"
                 
                wire:navigate
                   wire:click="setActiveSubMenu('attendance', 'check')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-violet-700/50 transition-all {{ Request::routeIs('attendance.check') ? 'text-violet-400' : '' }}">
                    <span class="w-2 h-2 rounded-full bg-slate-500 mr-2 {{ Request::routeIs('attendance.check') ? 'bg-violet-400' : '' }}"></span>
                    <span>Absen Masuk/Pulang</span>
                </a>
                <a href="{{ route('attendance.history') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('attendance', 'history')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-violet-700/50 transition-all {{ Request::routeIs('attendance.history') ? 'text-violet-400' : '' }}">
                    <span class="w-2 h-2 rounded-full bg-slate-500 mr-2 {{ Request::routeIs('attendance.history') ? 'bg-violet-400' : '' }}"></span>
                    <span>Riwayat Absensi</span>
                </a>
            </div>
        </div>
        
        <!-- Leave Management -->
        <div x-data="{ open: '{{ Request::routeIs('leave*') ? 'true' : 'false' }}' === 'true' }">
            <button 
                @click="open = !open" 
                wire:click="toggleMenu('leave')"
                class="w-full flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-violet-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('leave*') ? 'bg-gradient-to-r from-violet-600/40 to-indigo-500/40 shadow-md text-white font-medium' : '' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('leave*') ? 'text-violet-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-sm flex-1 text-left">Cuti & Izin</span>
                <svg 
                    class="w-4 h-4 transition-transform duration-300" 
                    :class="{'rotate-180': open}" 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            
            <div 
                x-show="open" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150" 
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="pl-12 pr-3 space-y-1 mt-1"
            >
                <a href="{{ route('leave.apply') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('leave', 'apply')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-violet-700/50 transition-all {{ Request::routeIs('leave.apply') ? 'text-violet-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('leave.apply') ? 'bg-violet-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Ajukan Cuti</span>
                </a>
                <a href="{{ route('leave.history') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('leave', 'history')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-violet-700/50 transition-all {{ Request::routeIs('leave.history') ? 'text-violet-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('leave.history') ? 'bg-violet-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Riwayat Cuti</span>
                </a>
            </div>
        </div>
        
        <!-- Payslip -->
        <a href="{{ route('salary.payslip') }}" 
        wire:navigate
           wire:click="setActiveMenu('salary.payslip')"
           class="flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-violet-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('salary.payslip') ? 'bg-gradient-to-r from-violet-600/40 to-indigo-500/40 shadow-md text-white font-medium' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('salary.payslip') ? 'text-violet-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
            </svg>
            <span class="font-medium text-sm">Slip Gaji</span>
        </a>
    </nav>
    
    <!-- Footer with enhanced styling - Updated to use the layout's modal -->
    <div class="px-4 pb-6">
        <button 
            x-data="{}"
            @click="
                $dispatch('open-header-modal', { 
                    title: 'Konfirmasi Logout',
                    message: 'Apakah Anda yakin ingin keluar dari sistem?',
                    confirmText: 'Ya, Logout',
                    cancelText: 'Batal',
                    confirmAction: 'logout'
                })
            " 
            class="group w-full flex items-center justify-center px-4 py-3 text-white bg-gradient-to-r from-violet-600 to-indigo-500 rounded-xl shadow-lg hover:shadow-indigo-500/20 hover:scale-[1.02] transition-all duration-300 focus:outline-none"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
            </svg>
            <span class="font-medium text-sm">Logout</span>
        </button>
    </div>
</div>