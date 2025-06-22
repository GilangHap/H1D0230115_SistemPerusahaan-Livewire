<div class="space-y-6">
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-blue-100 to-cyan-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-xl font-semibold text-slate-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                    Pengajuan Cuti
                </h1>
                <p class="text-slate-500 mt-1 pl-8">Ajukan permohonan cuti disini</p>
            </div>
            
            <div class="flex items-center px-5 py-3 bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 rounded-lg border border-blue-100/80 shadow-sm">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-500 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <span class="text-sm font-medium text-slate-500">Sisa Cuti</span>
                    <div class="flex items-center">
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">{{ $remainingLeaves }}</span>
                        <span class="ml-1 text-blue-600">hari</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Enhanced Leave Application Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
                <!-- Decorative element -->
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-bl from-blue-50 to-indigo-50 rounded-full opacity-70"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center mb-5">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-medium text-slate-800">Form Pengajuan Cuti</h2>
                    </div>
                    
                    @if (session()->has('message'))
                        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 shadow-sm animate-pulse">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-semibold text-green-800">Sukses!</h3>
                                    <p class="text-sm text-green-700">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if (session()->has('error'))
                        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm0 4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-semibold text-red-800">Kesalahan!</h3>
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <form wire:submit.prevent="submitLeave">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                            <!-- Start Date -->
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-slate-700 mb-1">
                                    Tanggal Mulai
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 group-hover:text-blue-500 transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input 
                                        type="date" 
                                        id="tanggal_mulai" 
                                        wire:model.live="tanggal_mulai" 
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 group-hover:border-blue-300 transition-colors"
                                    >
                                </div>
                                @error('tanggal_mulai') 
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <!-- End Date -->
                            <div>
                                <label for="tanggal_akhir" class="block text-sm font-medium text-slate-700 mb-1">
                                    Tanggal Akhir
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 group-hover:text-blue-500 transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </div>
                                    <input 
                                        type="date" 
                                        id="tanggal_akhir" 
                                        wire:model.live="tanggal_akhir" 
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 group-hover:border-blue-300 transition-colors"
                                    >
                                </div>
                                @error('tanggal_akhir') 
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <!-- Total Days with enhanced styling -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-slate-700 mb-1">
                                    Jumlah Hari
                                </label>
                                <div class="flex items-center">
                                    <div class="px-4 py-2 bg-gradient-to-r from-slate-100 to-slate-50 rounded-lg border border-slate-200 text-slate-800 font-medium flex items-center shadow-sm">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        {{ $jumlah_hari }} hari
                                    </div>
                                    <span class="ml-2 text-xs text-slate-500">(Tidak termasuk akhir pekan)</span>
                                </div>
                            </div>
                            
                            <!-- Leave Status with enhanced styling -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">
                                    Status Pengajuan
                                </label>
                                <div class="px-4 py-2 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-lg border border-yellow-200 text-yellow-800 font-medium flex items-center shadow-sm">
                                    <div class="w-7 h-7 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    Menunggu Persetujuan
                                </div>
                            </div>
                            
                            <!-- Reason with enhanced styling -->
                            <div class="md:col-span-2">
                                <label for="alasan" class="block text-sm font-medium text-slate-700 mb-1">
                                    Alasan Cuti
                                </label>
                                <div class="relative">
                                    <textarea 
                                        id="alasan" 
                                        wire:model="alasan" 
                                        rows="3"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 pl-10"
                                        placeholder="Tuliskan alasan cuti anda disini..."
                                    ></textarea>
                                    <div class="absolute top-3 left-3 text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('alasan') 
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-end">
                            <button 
                                type="submit" 
                                class="relative overflow-hidden group py-2.5 px-6 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center"
                            >
                                <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-white rounded-full group-hover:w-32 group-hover:h-32 opacity-10"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                                </svg>
                                <span class="relative">Submit Pengajuan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Recent Leave Requests -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
                <!-- Decorative element -->
                <div class="absolute -top-16 -left-16 w-32 h-32 bg-gradient-to-br from-indigo-50 to-cyan-50 rounded-full opacity-70"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-medium text-slate-800">Pengajuan Terakhir</h2>
                    </div>
                    
                    @if($recentLeaves->isEmpty())
                        <div class="py-8 flex flex-col items-center justify-center text-center bg-gradient-to-r from-slate-50 to-gray-50 rounded-lg border border-dashed border-slate-200">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-slate-100 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-slate-500">Belum ada riwayat pengajuan cuti</p>
                            <button 
                                wire:click="$dispatch('scrollTo', { selector: '#tanggal_mulai' })"
                                class="mt-4 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm font-medium rounded-lg transition-colors inline-flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                </svg>
                                Buat Pengajuan Baru
                            </button>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($recentLeaves as $leave)
                                <div class="p-4 rounded-lg bg-white border border-slate-200 hover:border-blue-300 hover:shadow-md transition-all group">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h3 class="font-semibold text-slate-800">{{ $leave->jumlah_hari }} hari</h3>
                                            <p class="text-xs text-slate-500">
                                                <span class="inline-flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($leave->tanggal_mulai)->format('j M Y') }} - {{ \Carbon\Carbon::parse($leave->tanggal_akhir)->format('j M Y') }}
                                                </span>
                                            </p>
                                        </div>
                                        
                                        @switch($leave->status)
                                            @case('approved')
                                                <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200/50 shadow-sm flex items-center">
                                                    <span class="w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                                                    Disetujui
                                                </span>
                                                @break
                                            @case('rejected')
                                                <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border border-red-200/50 shadow-sm flex items-center">
                                                    <span class="w-2 h-2 rounded-full bg-red-500 mr-1"></span>
                                                    Ditolak
                                                </span>
                                                @break
                                            @case('canceled')
                                                <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border border-red-200/50 shadow-sm flex items-center">
                                                    <span class="w-2 h-2 rounded-full bg-red-500 mr-1"></span>
                                                    Dibatalkan
                                                </span>
                                                @break
                                            @default
                                                <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200/50 shadow-sm flex items-center">
                                                    <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse mr-1"></span>
                                                    Menunggu
                                                </span>
                                        @endswitch
                                    </div>
                                    
                                    <div class="mt-3 pt-3 border-t border-slate-100">
                                        <p class="text-sm text-slate-600 line-clamp-2 group-hover:line-clamp-none transition-all duration-300">{{ $leave->alasan }}</p>
                                    </div>
                                    
                                    @if($leave->catatan)
                                        <div class="mt-2 p-2 bg-gradient-to-r from-slate-50 to-gray-50 rounded border border-slate-200 text-xs text-slate-700">
                                            <span class="font-semibold text-slate-800">Catatan:</span> {{ $leave->catatan }}
                                        </div>
                                    @endif
                                    
                                    <div class="mt-2 flex justify-between items-center">
                                        <div class="text-xs text-slate-500 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($leave->created_at)->diffForHumans() }}
                                        </div>
                                        
                                        @if($leave->status === 'pending')
                                        <button 
                                            x-data="{}"
                                            x-on:click="if (confirm('Apakah Anda yakin ingin membatalkan pengajuan cuti ini?')) { $wire.cancelLeave({{ $leave->id }}) }"
                                            class="text-xs text-red-600 hover:text-red-800 transition-colors flex items-center"
                                            title="Batalkan pengajuan"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                            Batalkan
                                        </button>
                                    @endif
                                    </div>
                                </div>
                            @endforeach
                            
                            <a href="{{ route('leave.history') }}" class="block text-center text-sm py-3 bg-white hover:bg-slate-50 border border-dashed border-slate-200 hover:border-blue-300 rounded-lg text-blue-600 hover:text-blue-800 font-medium transition-all duration-200">
                                <div class="flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    Lihat Semua Riwayat
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
