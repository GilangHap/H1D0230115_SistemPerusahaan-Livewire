<div 
    class="h-screen w-72 bg-gradient-to-br from-slate-900 to-slate-800 border-r border-slate-700/30 shadow-xl flex flex-col fixed transition-transform duration-300 ease-in-out"
    x-data="{ activeMenu: @entangle('activeMenu') }"
    wire:ignore.self
>
    <!-- Logo and Title Section -->
    <div class="flex flex-col items-center pt-8 pb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="h-10 w-10 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-600/20 animate-pulse-slow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-600">
                Admin Portal
            </h1>
        </div>
        <div class="relative group">
            <img 
                src="{{ Auth::user()->foto_profil 
                        ? Storage::url('profile-photos/' . Auth::user()->foto_profil) 
                        : asset('images/default-avatar.svg') }}" 
                alt="Profile Picture" 
                class="w-20 h-20 rounded-full object-cover ring-2 ring-blue-500/50 shadow-md shadow-blue-500/10 hover:ring-blue-400 transition-all duration-300"
            >
            

            <a href="{{ route('profile') }}" wire:navigate class="absolute bottom-0 right-0 bg-gradient-to-r from-blue-600 to-cyan-500 text-white p-1.5 rounded-full shadow-lg transform transition-transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </div>
        <h2 class="mt-4 font-medium text-white">{{ Auth::user()->nama }}</h2>
        <span class="text-sm text-slate-300">{{ Auth::user()->jabatan->nama_jabatan ?? 'Administrator' }}</span>
        <div class="mt-2 px-3 py-1 rounded-full bg-blue-500/20 text-xs text-blue-300 border border-blue-500/30">
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
        <a href="{{ route('admin.dashboard') }}" 
            wire:navigate
           wire:click="setActiveMenu('dashboard')"
           class="flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-slate-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600/40 to-cyan-500/40 shadow-md text-white font-medium' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('admin.dashboard') ? 'text-blue-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span class="font-medium text-sm">Dashboard</span>
        </a>
        
        <!-- Employees Management with improved animations -->
        <div x-data="{ open: '{{ Request::routeIs('member*') ? 'true' : 'false' }}' === 'true' }">
            <button 
                @click="open = !open" 
                wire:click="toggleMenu('employees')"
                class="w-full flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-slate-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('member*') ? 'bg-gradient-to-r from-blue-600/40 to-cyan-500/40 shadow-md text-white font-medium' : '' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('member*') ? 'text-blue-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                <span class="font-medium text-sm flex-1 text-left">Manajemen Pegawai</span>
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
                <a href="{{ route('member') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('member', 'index')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-700/50 transition-all {{ Request::routeIs('member') ? 'text-blue-400' : '' }}">
                    <span class="w-2 h-2 rounded-full bg-slate-500 mr-2 {{ Request::routeIs('member') ? 'bg-blue-400' : '' }}"></span>
                    <span>Daftar Pegawai</span>
                </a>
                <a href="{{ route('member.create') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('member', 'create')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-700/50 transition-all {{ Request::routeIs('member.create') ? 'text-blue-400' : '' }}">
                    <span class="w-2 h-2 rounded-full bg-slate-500 mr-2 {{ Request::routeIs('member.create') ? 'bg-blue-400' : '' }}"></span>
                    <span>Tambah Pegawai</span>
                </a>
            </div>
        </div>
        
        <!-- Master Data -->
        <div x-data="{ open: '{{ Request::routeIs('departement*') || Request::routeIs('position*') ? 'true' : 'false' }}' === 'true' }">
            <button 
                @click="open = !open" 
                wire:click="toggleMenu('master')"
                class="w-full flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-slate-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('departement*') || Request::routeIs('position*') ? 'bg-gradient-to-r from-blue-600/40 to-cyan-500/40 shadow-md text-white font-medium' : '' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('departement*') || Request::routeIs('position*') ? 'text-blue-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="font-medium text-sm flex-1 text-left">Master Data</span>
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
                <!-- Submenu items with improved styling -->
                <a href="{{ route('position.manage') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('master', 'jabatan')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-700/50 transition-all {{ Request::routeIs('position.manage') ? 'text-blue-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('position.manage') ? 'bg-blue-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Jabatan</span>
                </a>
                <a href="{{ route('departement.manage') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('departement', 'manage')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-700/50 transition-all {{ Request::routeIs('departement.manage') ? 'text-blue-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('departement.manage') ? 'bg-blue-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Departemen</span>
                </a>
            </div>
        </div>

        <!-- Reports -->
        <div x-data="{ open: '{{ Request::routeIs('attendance*') || Request::routeIs('leave*') || Request::routeIs('salary.report') ? 'true' : 'false' }}' === 'true' }">
            <button 
                @click="open = !open" 
                wire:click="toggleMenu('reports')"
                class="w-full flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-slate-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('attendance.member*') || Request::routeIs('leave*') || Request::routeIs('salary/report') ? 'bg-gradient-to-r from-blue-600/40 to-cyan-500/40 shadow-md text-white font-medium' : '' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('attendance.all-member*') || Request::routeIs('leave*') || Request::routeIs('salary.report') ? 'text-blue-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-sm flex-1 text-left">Laporan</span>
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
                <a href="{{ route('attendance.all-member') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('reports', 'absensi')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-700/50 transition-all {{ Request::routeIs('attendance.all-member') ? 'text-blue-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('attendance.all-member') ? 'bg-blue-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Absensi</span>
                </a>
                <a href="{{ route('leave.report') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('leave', 'report')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-700/50 transition-all {{ Request::routeIs('leave.report') ? 'text-blue-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('leave.report') ? 'bg-blue-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Cuti</span>
                </a>
                <a href="{{ route('salary.report') }}" 
                wire:navigate
                   wire:click="setActiveSubMenu('salary', 'report')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-700/50 transition-all {{ Request::routeIs('salary.report') ? 'text-blue-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('salary.report') ? 'bg-blue-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Payroll</span>
                </a>
            </div>
        </div>

        <!-- Payslip -->
        <a href="{{ route('salary.payslip') }}" 
        wire:navigate
           wire:click="setActiveMenu('salary.payslip')"
           class="flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-slate-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('salary.payslip') ? 'bg-gradient-to-r from-blue-600/40 to-cyan-500/40 shadow-md text-white font-medium' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('salary.payslip') ?  'text-blue-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
            </svg>
            <span class="font-medium text-sm">Slip Gaji</span>
        </a>

    <!-- Footer with enhanced styling -->
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