<div>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Decorative elements for fun styling -->
        <div class="absolute top-10 left-10 w-32 h-32 bg-gradient-to-br from-blue-300/30 to-purple-300/30 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-gradient-to-br from-indigo-300/30 to-cyan-300/30 rounded-full filter blur-3xl"></div>
        <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-gradient-to-br from-amber-300/20 to-pink-300/20 rounded-full filter blur-3xl"></div>

        <div class="max-w-md w-full relative">
            <!-- Decorative Card Elements -->
            <div class="absolute -top-6 -left-6 w-12 h-12 bg-blue-500 rounded-lg transform rotate-12 opacity-30"></div>
            <div class="absolute -bottom-6 -right-6 w-12 h-12 bg-indigo-600 rounded-lg transform -rotate-12 opacity-30"></div>
            
            <div class="bg-white/80 backdrop-blur-lg shadow-xl rounded-2xl p-8 border border-white/50 relative z-10">
                <div class="text-center mb-8">
                    <div class="mx-auto h-16 w-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg mb-4 transform transition-all hover:rotate-6 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">
                        Sistem Perusahaan
                    </h2>
                    <p class="mt-2 text-slate-500">
                        Masuk untuk mengakses dashboard anda
                    </p>
                </div>
                
                @if (session()->has('error'))
                    <div class="mb-5 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg flex items-center space-x-3" role="alert">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form class="space-y-6" wire:submit.prevent="login">
                    <div class="space-y-4">
                        <div>
                            <label for="nip" class="block text-sm font-medium text-slate-700 mb-1">NIP</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model="nip" id="nip" name="nip" type="text" autocomplete="username" required 
                                    class="block w-full pl-10 px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 text-slate-800 placeholder-slate-400 transition-all" 
                                    placeholder="Masukkan NIP anda">
                            </div>
                            @error('nip') 
                                <p class="mt-1 text-red-500 text-sm flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div x-data="{ showPassword: false }">
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input 
                                    wire:model="password" 
                                    id="password" 
                                    name="password" 
                                    :type="showPassword ? 'text' : 'password'"
                                    autocomplete="current-password" 
                                    required 
                                    class="block w-full pl-10 pr-12 px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 text-slate-800 placeholder-slate-400 transition-all" 
                                    placeholder="Masukkan password anda"
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button 
                                        type="button" 
                                        @click="showPassword = !showPassword" 
                                        class="focus:outline-none"
                                        aria-label="Toggle password visibility"
                                    >
                                        <template x-if="!showPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500 hover:text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                            </svg>
                                        </template>
                                        <template x-if="showPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 hover:text-indigo-800" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </template>
                                    </button>
                                </div>
                            </div>
                            @error('password') 
                                <p class="mt-1 text-red-500 text-sm flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                wire:model="remember" 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="h-5 w-5 text-indigo-600 focus:ring-indigo-400 border-slate-300 rounded transition-all cursor-pointer"
                            >
                            <label for="remember" class="ml-2 block text-sm text-slate-700 select-none cursor-pointer">
                                Ingat saya
                            </label>
                        </div>
                        
                        <div>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline transition-all font-medium">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-600/40 transition-all duration-300"
                            wire:loading.attr="disabled"
                        >
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg 
                                    wire:loading.remove 
                                    wire:target="login" 
                                    class="h-5 w-5 text-indigo-300 group-hover:text-indigo-200" 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 20 20" 
                                    fill="currentColor" 
                                    aria-hidden="true"
                                >
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                                <svg 
                                    wire:loading 
                                    wire:target="login" 
                                    class="animate-spin h-5 w-5 text-white" 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    fill="none" 
                                    viewBox="0 0 24 24"
                                >
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                            <span wire:loading.remove wire:target="login">Masuk</span>
                            <span wire:loading wire:target="login">Memproses...</span>
                        </button>
                    </div>
                </form>
                
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-slate-500">atau</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="text-center text-sm text-slate-500">
                            Belum memiliki akun? 
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-800 transition-colors hover:underline">
                                Hubungi Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 text-center text-xs text-slate-500">
                &copy; {{ date('Y') }} Sistem Perusahaan. All rights reserved.
            </div>
        </div>
    </div>
</div>
