<!DOCTYPE html>
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem Perusahaan' }}</title>
    
    <!-- Google Fonts - Let's use a modern font combination -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        },
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            },
            plugins: [],
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Add higher z-index to modal */
        .fixed.inset-0.z-50 {
            z-index: 9999 !important;
        }
        
        /* Ensure logout dialog is on top */
        .logout-confirmation {
            z-index: 9999 !important;
        }
        
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Add smooth transitions */
        .page-transition {
            transition: all 0.3s ease-in-out;
        }
        
        /* Custom animation for notifications */
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .slide-in-right {
            animation: slideInRight 0.3s forwards;
        }
    </style>
    
    @livewireStyles
</head>
<body class="font-sans antialiased bg-slate-50/80">
    <div class="min-h-screen flex">
        <!-- Sidebar based on role -->
        @if (auth()->check())
            @php
                $role = auth()->user()->jabatan->role->name ?? 'staff';
            @endphp
            
            <div class="w-72 min-h-screen fixed left-0 top-0 z-20 md:relative md:h-auto">
                @if($role === 'admin')
                    @livewire('sidebar.admin')
                @elseif($role === 'atasan')
                    @livewire('sidebar.atasan')
                @else
                    @livewire('sidebar.staff')
                @endif
            </div>
            
            <div class="hidden fixed inset-0 bg-black/50 z-10 md:hidden" 
                 x-data="{ open: false }" 
                 x-show="open" 
                 @click="open = false">
            </div>
        @endif

        <!-- Main Content Container -->
        <div class="flex-1 flex flex-col min-h-screen ">
            <!-- Top Navigation Header -->
            <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-slate-200/70">
                <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Toggle Sidebar Button (for mobile) -->
                            @if(auth()->check())
                                <button type="button" 
                                        x-data="{}" 
                                        @click="$dispatch('toggle-sidebar')" 
                                        class="inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 lg:hidden">
                                    <span class="sr-only">Open sidebar</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            @endif
                            
                            <!-- Page Title -->
                            <h1 class="text-xl font-semibold text-slate-800 ml-2 md:ml-0">
                                {{ $title ?? 'Dashboard' }}
                            </h1>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <!-- Search -->
                            <div class="hidden md:flex md:mr-1">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="search" placeholder="Search..." class="block w-full pl-10 pr-3 py-1.5 border border-slate-300 rounded-lg text-sm leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>
                            
                            <!-- Notifications -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="p-1.5 text-slate-500 rounded-lg hover:text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <!-- Add a badge for notifications count if needed -->
                                    @if(auth()->check() && isset($notificationsCount) && $notificationsCount > 0)
                                        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/3 bg-red-500 rounded-full">
                                            {{ $notificationsCount }}
                                        </span>
                                    @endif
                                </button>
                                
                                <!-- Notifications dropdown -->
                                <div 
                                    x-cloak
                                    x-show="open" 
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="origin-top-right absolute right-0 mt-2 w-80 rounded-lg shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                    <div class="px-4 py-2 border-b border-slate-200">
                                        <h3 class="text-sm font-semibold text-slate-800">Notifikasi</h3>
                                    </div>
                                    <div class="max-h-64 overflow-y-auto scrollbar-hide">
                                        <!-- Empty state -->
                                        <div class="text-center py-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="text-sm text-slate-500 mt-2">Tidak ada notifikasi baru</p>
                                        </div>
                                    </div>
                                    <div class="px-4 py-2 border-t border-slate-200 text-center">
                                        <a href="#" class="text-xs text-primary-600 hover:text-primary-800 font-medium">Lihat Semua Notifikasi</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="flex items-center max-w-xs rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full object-cover border border-slate-200" 
                                         src="{{ auth()->check() 
                                                ? (auth()->user()->foto_profil 
                                                    ? Storage::url('profile-photos/' . auth()->user()->foto_profil) 
                                                    : asset('images/default-avatar.svg')) 
                                                : asset('images/default-avatar.svg') }}" 
                                         alt="Profile photo">
                                    <span class="ml-2 hidden md:flex flex-col items-start">
                                        <span class="text-sm font-medium text-slate-700">{{ auth()->check() ? auth()->user()->nama : 'Guest' }}</span>
                                        <span class="text-xs text-slate-500">{{ auth()->check() ? (auth()->user()->jabatan->nama_jabatan ?? 'User') : 'Guest' }}</span>
                                    </span>
                                    <svg class="ml-1 h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                
                                <!-- Dropdown menu -->
                                <div 
                                    x-cloak
                                    x-show="open" 
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" 
                                    role="menu" 
                                    aria-orientation="vertical" 
                                    aria-labelledby="user-menu-button" 
                                    tabindex="-1">
                                    
                                    @if(auth()->check())
                                        <div class="px-4 py-2 border-b border-slate-200">
                                            <p class="text-sm font-medium text-slate-800">{{ auth()->user()->nama }}</p>
                                            <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                                        </div>
                                        <a href="{{ route('profile') }}" wire:navigate class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100" role="menuitem">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                                </svg>
                                                Profil Saya
                                            </div>
                                        </a>
                                        <div class="border-t border-slate-200 my-1"></div>
                                        <button 
                                            type="button" 
                                            x-data="{}"
                                            @click="
                                                $dispatch('open-header-modal', { 
                                                    title: 'Konfirmasi Logout',
                                                    message: 'Apakah Anda yakin ingin keluar dari sistem?',
                                                    confirmText: 'Ya, Logout',
                                                    cancelText: 'Batal',
                                                    confirmAction: 'logout'
                                                });
                                                open = false;
                                            " 
                                            class="block w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-100" 
                                            role="menuitem"
                                        >
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                                </svg>
                                                Logout
                                            </div>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100" role="menuitem">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd" />
                                                </svg>
                                                Login
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/80">
                <div class="container mx-auto px-4 sm:px-6 py-8">
                    {{ $slot }}
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200 py-4 text-center">
                <div class="container mx-auto px-6">
                    <p class="text-center text-sm text-slate-500">
                        © {{ date('Y') }} Sistem Perusahaan. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </div>
    
    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('swal:modal', (data) => {
                Swal.fire({
                    title: data[0].title,
                    text: data[0].text,
                    icon: data[0].icon,
                    confirmButtonColor: '#4F46E5',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>

    <div
    x-data="{
        show: false,
        title: '',
        message: '',
        confirmText: '',
        cancelText: '',
        confirmAction: ''
    }"
    @open-header-modal.window="
        show = true;
        title = $event.detail.title;
        message = $event.detail.message;
        confirmText = $event.detail.confirmText;
        cancelText = $event.detail.cancelText;
        confirmAction = $event.detail.confirmAction;
    "
    x-show="show"
    x-cloak
    class="fixed inset-0 z-[9999] overflow-y-auto"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-40 transition-opacity" @click="show = false"></div>
    
    <!-- Modal content -->
    <div class="flex min-h-screen items-center justify-center">
        <div 
            class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-md w-full m-4"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
        >
            <!-- Modal header -->
            <div class="bg-gradient-to-r from-violet-600 to-indigo-600 px-6 py-4">
                <h3 class="text-lg font-medium text-white" x-text="title"></h3>
            </div>
            
            <!-- Modal body -->
            <div class="px-6 py-4">
                <p class="text-gray-700" x-text="message"></p>
            </div>
            
            <!-- Modal footer -->
            <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-2">
                <button 
                    @click="show = false" 
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors"
                    x-text="cancelText"
                ></button>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button 
                        type="submit"
                        @click="show = false"
                        class="px-4 py-2 bg-gradient-to-r from-violet-600 to-indigo-600 text-white rounded-lg hover:from-violet-700 hover:to-indigo-700 transition-colors"
                        x-text="confirmText"
                    ></button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>