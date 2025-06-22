<div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-300">
    <div class="flex justify-between items-center mb-5">
        <h3 class="text-slate-800 font-semibold flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Absensi Hari Ini
        </h3>
        <div class="bg-slate-100 py-1 px-3 rounded-full text-xs font-medium text-slate-700">
            Jam Masuk: {{ $jamMasukLimit }}
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg {{ session()->has('status') && session('status') === 'terlambat' ? 'bg-amber-50 border border-amber-200' : 'bg-green-50 border border-green-200' }}">
            <div class="flex items-center">
                @if(session()->has('status') && session('status') === 'terlambat')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                <span class="text-amber-700 font-medium">{{ session('message') }}</span>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-green-700 font-medium">{{ session('message') }}</span>
                @endif
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm0 4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
                <span class="text-red-700 font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="text-center mb-6" wire:poll.1000ms="updateCurrentTime">
        <div class="relative inline-flex justify-center items-center mb-2">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full opacity-70 blur-lg"></div>
            <div class="relative bg-white rounded-full border border-slate-200 px-6 py-3 shadow-sm">
                <div class="text-4xl font-bold text-slate-800">
                    {{ $currentTime }}
                </div>
            </div>
        </div>
        <p class="text-slate-500 mt-2">{{ now()->format('l, d F Y') }}</p>
        
        <!-- Status terlambat indicator -->
        @if($status === 'not-checked-in' && $isTerlambat)
            <p class="mt-2 inline-block bg-amber-100 text-amber-800 text-sm px-3 py-1 rounded-full font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4 mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Anda akan tercatat terlambat
            </p>
        @endif
    </div>

    <div class="flex justify-center">
        <div class="w-full max-w-md">
            @if ($status === 'not-logged-in')
                <div class="p-5 rounded-lg bg-amber-50 border border-amber-200">
                    <div class="flex items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="font-medium text-amber-800">Silakan Login</h3>
                    </div>
                    <p class="text-amber-700">Anda harus login terlebih dahulu untuk melakukan absensi.</p>
                </div>
            @elseif ($status === 'error')
                <div class="p-5 rounded-lg bg-red-50 border border-red-200">
                    <div class="flex items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="font-medium text-red-800">Terjadi Kesalahan</h3>
                    </div>
                    <p class="text-red-700">Sistem tidak dapat memuat data absensi. Silakan refresh halaman atau hubungi administrator.</p>
                </div>
            @elseif ($status === 'not-checked-in')
                <div class="mb-4">
                    <label for="keterangan" class="block text-sm font-medium text-slate-700 mb-1">Keterangan (Opsional)</label>
                    <textarea 
                        wire:model="keterangan" 
                        id="keterangan" 
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-colors" 
                        rows="2"
                    ></textarea>
                </div>
                <button 
                    wire:click="checkIn" 
                    class="w-full py-3 px-4 {{ $isTerlambat ? 'bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700' : 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700' }} text-white font-medium rounded-lg shadow-sm hover:shadow-md flex items-center justify-center transition-all duration-300"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="checkIn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                        </svg>
                        {{ $isTerlambat ? 'Absen Masuk (Terlambat)' : 'Absen Masuk' }}
                    </span>
                    <span wire:loading wire:target="checkIn" class="flex items-center">
                        <svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>

            @elseif ($status === 'checked-in')
                <div class="mb-4 p-4 rounded-lg {{ $isTerlambat ? 'bg-amber-50 border border-amber-200' : 'bg-blue-50 border border-blue-200' }}">
                    <div class="flex items-start">
                        @if ($isTerlambat)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 mr-2 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="text-amber-700 font-medium mb-1">Anda sudah absen masuk (Terlambat)</p>
                            <p class="text-amber-600 text-sm">Waktu masuk: <span class="font-bold">{{ $jamMasuk }}</span></p>
                        </div>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="text-blue-700 font-medium mb-1">Anda sudah absen masuk</p>
                            <p class="text-blue-600 text-sm">Waktu masuk: <span class="font-bold">{{ $jamMasuk }}</span></p>
                        </div>
                        @endif
                    </div>
                </div>

                <button 
                    wire:click="checkOut" 
                    class="w-full py-3 px-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md flex items-center justify-center transition-all duration-300"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="checkOut">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm10.293 9.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 111.414 1.414L11.414 9H17a1 1 0 110 2h-5.586l1.293 1.293z" clip-rule="evenodd" />
                        </svg>
                        Absen Pulang
                    </span>
                    <span wire:loading wire:target="checkOut" class="flex items-center">
                        <svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>

            @else
                <div class="p-5 rounded-lg bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200">
                    <div class="flex items-center mb-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-medium text-green-800">Absensi Selesai</h3>
                    </div>

                    <p class="text-green-700 mb-4">Anda sudah melakukan absensi penuh hari ini:</p>
                    
                    <div class="flex flex-col space-y-2 bg-white p-4 rounded-lg border border-green-100">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $isTerlambat ? 'text-amber-500' : 'text-green-500' }} mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <div>
                                <div class="text-sm text-slate-500">
                                    {{ $isTerlambat ? 'Absen Masuk (Terlambat):' : 'Absen Masuk:' }}
                                </div>
                                <div class="font-semibold text-slate-800">{{ $jamMasuk }}</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <div>
                                <div class="text-sm text-slate-500">Absen Pulang:</div>
                                <div class="font-semibold text-slate-800">{{ $jamPulang }}</div>
                            </div>
                        </div>
                    </div>
                    
                    @if($isTerlambat)
                    <div class="mt-4 p-3 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-700">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span>
                                Anda tercatat terlambat pada hari ini. Mohon untuk datang tepat waktu pada hari berikutnya.
                            </span>
                        </div>
                    </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>