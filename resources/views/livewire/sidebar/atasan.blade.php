<div 
    class="h-screen w-72 bg-gradient-to-br from-emerald-900 to-emerald-800 border-r border-emerald-700/30 shadow-xl flex flex-col fixed transition-transform duration-300 ease-in-out"
    x-data="{ activeMenu: @entangle('activeMenu') }"
    wire:ignore.self
>
    @php
        use Illuminate\Support\Facades\Storage;
    @endphp
    
    <!-- Logo and Title Section -->
    <div class="flex flex-col items-center pt-8 pb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="h-10 w-10 bg-gradient-to-tr from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-600/20 animate-pulse-slow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 6a3 3 0 013-3h2a3 3 0 013 3v2a3 3 0 01-3 3H9a3 3 0 01-3-3V6zm9 3a1 1 0 10-2 0v8a1 1 0 102 0V9zm-4 0a1 1 0 10-2 0v8a1 1 0 102 0V9z" clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-500">
                Manager Portal
            </h1>
        </div>
        <div class="relative group">
            <img 
                src="{{ Auth::user()->foto_profil 
                    ? Storage::url('profile-photos/' . Auth::user()->foto_profil) 
                    : asset('images/default-avatar.svg') }}" 
                alt="Profile Picture" 
                class="w-20 h-20 rounded-full object-cover ring-2 ring-emerald-500/50 shadow-md shadow-emerald-500/10 hover:ring-emerald-400 transition-all duration-300"
            >
            <a href="{{ route('profile') }}" class="absolute bottom-0 right-0 bg-gradient-to-r from-emerald-600 to-teal-500 text-white p-1.5 rounded-full shadow-lg transform transition-transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </div>
        <h2 class="mt-4 font-medium text-white">{{ Auth::user()->nama }}</h2>
        <span class="text-sm text-slate-300">{{ Auth::user()->jabatan->nama_jabatan ?? 'Manager' }}</span>
        <div class="mt-2 px-3 py-1 rounded-full bg-emerald-500/20 text-xs text-emerald-300 border border-emerald-500/30">
            Online
        </div>
    </div>
    
    <!-- Divider with enhanced styling -->
    <div class="px-6">
        <div class="h-px bg-gradient-to-r from-transparent via-slate-400/20 to-transparent"></div>
    </div>
    
    <!-- Simplified Navigation with Livewire integration -->
    <nav class="flex-1 pt-6 px-4 pb-4 space-y-2 overflow-y-auto scrollbar-hide">
        <!-- Dashboard -->
        <a href="{{ route('atasan.dashboard') }}" 
           wire:navigate
           wire:click="setActiveMenu('dashboard')"
           class="flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-emerald-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('atasan.dashboard') ? 'bg-gradient-to-r from-emerald-600/40 to-teal-500/40 shadow-md text-white font-medium' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('atasan.dashboard') ? 'text-emerald-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span class="font-medium text-sm">Dashboard</span>
        </a>
        
        <!-- Tim Saya (without submenu) -->
        <a href="{{ route('departement.members', ['id' => Auth::user()->unit_kerja_id]) }}" 
        wire:navigate
        wire:click="setActiveMenu('tim')"
        class="flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-emerald-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('departement.members') && request()->route('id') == Auth::user()->unit_kerja_id ? 'bg-gradient-to-r from-emerald-600/40 to-teal-500/40 shadow-md text-white font-medium' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('departement.members') && request()->route('id') == Auth::user()->unit_kerja_id ? 'text-emerald-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
            </svg>
            <span class="font-medium text-sm">Tim Saya</span>
        </a>
        
        <!-- Persetujuan Cuti (without submenu) -->
        <a href="{{ route('leave.approve') }}" 
           wire:navigate
           wire:click="setActiveMenu('leave.approve')"
           class="flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-emerald-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('leave.approve') ? 'bg-gradient-to-r from-emerald-600/40 to-teal-500/40 shadow-md text-white font-medium' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('leave.approve') ? 'text-emerald-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="font-medium text-sm">Persetujuan Cuti</span>
        </a>
        
        <!-- Laporan with Submenu for Absensi and Gaji -->
        <div x-data="{ open: '{{ Request::routeIs('report.departement-salary') || Request::routeIs('attendance*')  ? 'true' : 'false' }}' === 'true' }">
            <button 
                @click="open = !open" 
                wire:click="toggleMenu('laporan')"
                class="w-full flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-emerald-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('report.departement-salary') || Request::routeIs('attendance*') ? 'bg-gradient-to-r from-emerald-600/40 to-teal-500/40 shadow-md text-white font-medium' : '' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('report.departement-salary') || Request::routeIs('attendance*') ? 'text-emerald-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
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
                <a href="{{ route('attendance.departement') }}" 
                   wire:navigate
                   wire:click="setActiveSubMenu('attendance', 'departement')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-emerald-700/50 transition-all {{ Request::routeIs('attendance.departement') ? 'text-emerald-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('attendance.departement') ? 'bg-emerald-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Laporan Absensi</span>
                </a>
                <a href="{{ route('report.departement-salary') }}" 
                   wire:navigate
                   wire:click="setActiveSubMenu('laporan', 'gaji')"
                   class="flex items-center px-4 py-2 text-sm text-slate-300 rounded-lg hover:bg-emerald-700/50 transition-all {{ Request::routeIs('report.departement-salary') ? 'text-emerald-400' : '' }}">
                    <div class="w-2 h-2 rounded-full {{ Request::routeIs('report.departement-salary') ? 'bg-emerald-400' : 'bg-slate-500' }} mr-2"></div>
                    <span>Laporan Gaji</span>
                </a>
            </div>
        </div>

        <!-- Payslip -->
        <a href="{{ route('salary.payslip') }}" 
        wire:navigate
           wire:click="setActiveMenu('salary.payslip')"
           class="flex items-center px-4 py-3 text-slate-200 rounded-xl hover:bg-emerald-700/50 hover:scale-[1.02] transition-all duration-200 {{ Request::routeIs('salary.payslip') ? 'bg-gradient-to-r from-emerald-600/40 to-teal-500/40 shadow-md text-white font-medium' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ Request::routeIs('salary.payslip') ? 'text-emerald-400' : 'text-slate-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
            </svg>
            <span class="font-medium text-sm">Slip Gaji</span>
        </a>
    </nav>
    
    <!-- Footer with logout button -->
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
            class="group w-full flex items-center justify-center px-4 py-3 text-white bg-gradient-to-r from-emerald-600 to-teal-500 rounded-xl shadow-lg hover:shadow-emerald-500/20 hover:scale-[1.02] transition-all duration-300 focus:outline-none"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
            </svg>
            <span class="font-medium text-sm">Logout</span>
        </button>
    </div>
</div>