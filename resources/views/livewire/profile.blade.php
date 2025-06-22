<div class="space-y-6" x-data="{ activeTab: @entangle('activeTab') }">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-indigo-100 to-violet-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-sky-100 to-indigo-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-xl font-semibold text-slate-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profil Saya
                </h1>
                <p class="text-slate-500 mt-1 pl-8">Kelola informasi profil dan kata sandi</p>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex border-b border-slate-200">
        <button 
            class="px-4 py-2 text-sm font-medium" 
            :class="activeTab === 'info' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-slate-500 hover:text-indigo-500'"
            wire:click="changeTab('info')"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Informasi Pribadi
        </button>
        <button 
            class="px-4 py-2 text-sm font-medium"
            :class="activeTab === 'security' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-slate-500 hover:text-indigo-500'"
            wire:click="changeTab('security')"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Keamanan
        </button>
        <button 
            class="px-4 py-2 text-sm font-medium"
            :class="activeTab === 'organization' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-slate-500 hover:text-indigo-500'"
            wire:click="changeTab('organization')"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Data Organisasi
        </button>
    </div>

    <!-- Content Area - Personal Information Tab -->
    <div class="space-y-6" x-data="{ showUpload: false }" x-show="activeTab === 'info'" x-cloak>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Profil
                </h3>

                <div class="mb-6 flex flex-col sm:flex-row items-center sm:items-start gap-6">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-full overflow-hidden bg-slate-100">
                            @if($foto_profil)
                                <img src="{{ Storage::url('profile-photos/' . $foto_profil) }}" alt="Profile Photo" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        @if($isEditing)
                            <div 
                                x-on:click="showUpload = true"
                                class="absolute inset-0 bg-black/30 rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="text-center sm:text-left">
                        <h4 class="text-lg font-medium text-slate-800">{{ $nama }}</h4>
                        <p class="text-sm text-slate-500">{{ $pegawai->unitKerja->nama_unit ?? 'No Unit' }}</p>
                        <p class="text-sm text-slate-500 mt-1">{{ $pegawai->jabatan->nama_jabatan ?? 'No Position' }}</p>
                        
                        @if($isEditing)
                            <div x-show="showUpload" class="mt-3">
                                <input 
                                    type="file" 
                                    wire:model="new_foto_profil" 
                                    id="foto_profil" 
                                    class="hidden"
                                    accept="image/*"
                                >
                                <label 
                                    for="foto_profil" 
                                    class="px-3 py-1.5 text-xs font-medium bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition rounded-md cursor-pointer"
                                >
                                    Pilih Foto
                                </label>
                                <button 
                                    type="button"
                                    x-on:click="showUpload = false"
                                    class="px-3 py-1.5 ml-2 text-xs font-medium bg-slate-100 text-slate-600 hover:bg-slate-200 transition rounded-md"
                                >
                                    Batal
                                </button>
                            </div>

                            @error('new_foto_profil')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror

                            @if ($new_foto_profil)
                                <p class="mt-2 text-xs text-indigo-600">
                                    Foto baru dipilih: {{ $new_foto_profil->getClientOriginalName() }}
                                </p>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="space-y-4">
                    @if(!$isEditing)
                        <!-- View Mode -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">NIP</label>
                                <p class="text-sm text-slate-800">{{ $pegawai->nip ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Nama Lengkap</label>
                                <p class="text-sm text-slate-800">{{ $nama ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Email</label>
                                <p class="text-sm text-slate-800">{{ $email ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Nomor Telepon</label>
                                <p class="text-sm text-slate-800">{{ $no_telp ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-medium text-slate-500 mb-1">Alamat</label>
                                <p class="text-sm text-slate-800">{{ $alamat ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-slate-200 pt-5 mt-6">
                            <button 
                                wire:click="startEditing"
                                type="button" 
                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Profil
                            </button>
                        </div>
                    @else
                        <!-- Edit Mode -->
                        <form wire:submit.prevent="updateProfile">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                                <div>
                                    <label for="nip" class="block text-xs font-medium text-slate-500 mb-1">NIP</label>
                                    <input 
                                        type="text" 
                                        id="nip" 
                                        value="{{ $pegawai->nip }}"
                                        disabled
                                        class="w-full rounded-md border-slate-300 px-4 py-2.5 text-sm text-slate-800 bg-slate-50"
                                    >
                                    <p class="mt-1 text-xs text-slate-500">NIP tidak dapat diubah</p>
                                </div>
                                
                                <div>
                                    <label for="nama" class="block text-xs font-medium text-slate-500 mb-1">Nama Lengkap</label>
                                    <input 
                                        type="text" 
                                        id="nama" 
                                        wire:model="nama" 
                                        class="w-full rounded-md border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama') border-rose-300 ring-1 ring-rose-300 @enderror"
                                    >
                                    @error('nama')
                                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-xs font-medium text-slate-500 mb-1">Email</label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        wire:model="email" 
                                        class="w-full rounded-md border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-rose-300 ring-1 ring-rose-300 @enderror"
                                    >
                                    @error('email')
                                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="no_telp" class="block text-xs font-medium text-slate-500 mb-1">Nomor Telepon</label>
                                    <input 
                                        type="text" 
                                        id="no_telp" 
                                        wire:model="no_telp" 
                                        class="w-full rounded-md border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('no_telp') border-rose-300 ring-1 ring-rose-300 @enderror"
                                    >
                                    @error('no_telp')
                                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="alamat" class="block text-xs font-medium text-slate-500 mb-1">Alamat</label>
                                    <textarea 
                                        id="alamat" 
                                        wire:model="alamat" 
                                        rows="3" 
                                        class="w-full rounded-md border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('alamat') border-rose-300 ring-1 ring-rose-300 @enderror"
                                    ></textarea>
                                    @error('alamat')
                                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="border-t border-slate-200 pt-5 mt-6 flex">
                                <button 
                                    type="submit" 
                                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Perubahan
                                </button>
                                <button 
                                    type="button" 
                                    wire:click="cancelEdit"
                                    class="ml-3 px-4 py-2 border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-500 flex items-center"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Batal
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area - Security Tab -->
    <div class="space-y-6" x-show="activeTab === 'security'" x-cloak>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    Keamanan Akun
                </h3>

                <div class="mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-base font-medium text-slate-800">Password</h4>
                            <p class="text-sm text-slate-500 mt-1">
                                @if($isChangingPassword)
                                    Ubah password anda. Pastikan menggunakan kombinasi huruf, angka, dan simbol.
                                @else
                                    ••••••••••••
                                @endif
                            </p>
                        </div>
                        
                        @if(!$isChangingPassword)
                            <button 
                                wire:click="startChangingPassword"
                                type="button" 
                                class="px-3 py-1.5 border border-slate-300 text-indigo-600 hover:bg-indigo-50 text-sm font-medium rounded-lg transition-colors"
                            >
                                Ubah
                            </button>
                        @endif
                    </div>

                    @if($isChangingPassword)
                        <form wire:submit.prevent="updatePassword" class="mt-4 bg-slate-50 p-4 rounded-lg border border-slate-200">
                            <div class="space-y-4">
                                <div>
                                    <label for="current_password" class="block text-xs font-medium text-slate-500 mb-1">Password Saat Ini</label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            id="current_password" 
                                            wire:model.defer="current_password" 
                                            class="w-full rounded-md border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('current_password') border-rose-300 ring-1 ring-rose-300 @enderror"
                                            placeholder="Masukkan password saat ini"
                                        >
                                    </div>
                                    @error('current_password')
                                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="new_password" class="block text-xs font-medium text-slate-500 mb-1">Password Baru</label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            id="new_password" 
                                            wire:model.defer="new_password" 
                                            class="w-full rounded-md border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('new_password') border-rose-300 ring-1 ring-rose-300 @enderror"
                                            placeholder="Buat password baru (min. 8 karakter)"
                                        >
                                    </div>
                                    @error('new_password')
                                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-xs font-medium text-slate-500 mb-1">Konfirmasi Password</label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            id="password_confirmation" 
                                            wire:model.defer="password_confirmation" 
                                            class="w-full rounded-md border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('password_confirmation') border-rose-300 ring-1 ring-rose-300 @enderror"
                                            placeholder="Konfirmasi password baru"
                                        >
                                    </div>
                                    @error('password_confirmation')
                                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex gap-2">
                                    <button 
                                        type="submit" 
                                        class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Password
                                    </button>
                                    <button 
                                        type="button" 
                                        wire:click="cancelChangingPassword"
                                        class="px-4 py-2 border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-500 flex items-center"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                
                <div class="border-t border-slate-200 pt-4 mt-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-base font-medium text-slate-800">Login Terakhir</h4>
                            <p class="text-sm text-slate-500 mt-1">{{ now()->subHours(rand(1, 48))->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area - Organization Tab -->
    <div class="space-y-6" x-show="activeTab === 'organization'" x-cloak>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Informasi Organisasi
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Unit Kerja</label>
                        <p class="text-sm text-slate-800">{{ $pegawai->unitKerja->nama_unit ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Jabatan</label>
                        <p class="text-sm text-slate-800">{{ $pegawai->jabatan->nama_jabatan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Role</label>
                        @if($pegawai->role)
                            <span class="inline-flex items-center mt-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                {{ ucfirst($pegawai->role->name) }}
                            </span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Gaji Pokok</label>
                        <p class="text-sm text-slate-800">Rp {{ number_format($pegawai->gaji_pokok ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Tunjangan Jabatan</label>
                        <p class="text-sm text-slate-800">Rp {{ number_format($pegawai->jabatan->tunjangan ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
                
                <div class="border-t border-slate-200 pt-5 mt-6">
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-amber-800">Catatan</h3>
                                <p class="text-sm text-amber-700 mt-1">
                                    Data organisasi hanya dapat diubah oleh departemen HR atau admin. Silakan hubungi mereka jika memerlukan perubahan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add x-cloak style and Alpine.js initialization -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</div>
