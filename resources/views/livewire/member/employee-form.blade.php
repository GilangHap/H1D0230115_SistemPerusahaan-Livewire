<div class="py-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 flex items-center">
                <span class="bg-blue-600/10 text-blue-600 p-1.5 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        @if($isEditMode)
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        @else
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        @endif
                    </svg>
                </span>
                {{ $isEditMode ? "Edit Pegawai" : "Tambah Pegawai Baru" }}
            </h1>
            <p class="mt-1 text-sm text-slate-600">
                {{ $isEditMode ? "Perbarui informasi pegawai yang sudah ada" : "Tambahkan pegawai baru ke dalam sistem" }}
            </p>
        </div>
        
        <div class="mt-4 md:mt-0 flex items-center gap-3">
            <a href="{{ route('member') }}" wire:navigate class="flex items-center justify-center px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl shadow-sm hover:bg-slate-50 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
        <!-- Step Progress -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-slate-200/60">
            <div class="max-w-3xl mx-auto">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex-1 flex items-center">
                        <div class="{{ $currentStep >= 1 ? 'bg-blue-600' : 'bg-slate-200' }} w-8 h-8 flex items-center justify-center rounded-full text-white font-medium">
                            1
                        </div>
                        <div class="ml-3">
                            <p class="{{ $currentStep >= 1 ? 'text-blue-600 font-medium' : 'text-slate-500' }} text-sm">
                                Informasi Dasar
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex-1 flex items-center">
                        <div class="w-full h-1 {{ $currentStep > 1 ? 'bg-blue-500' : 'bg-slate-200' }} rounded-full"></div>
                    </div>
                    
                    <div class="flex-1 flex items-center">
                        <div class="{{ $currentStep >= 2 ? 'bg-blue-600' : 'bg-slate-200' }} w-8 h-8 flex items-center justify-center rounded-full text-white font-medium">
                            2
                        </div>
                        <div class="ml-3">
                            <p class="{{ $currentStep >= 2 ? 'text-blue-600 font-medium' : 'text-slate-500' }} text-sm">
                                Informasi Kepegawaian
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex-1 flex items-center">
                        <div class="w-full h-1 {{ $currentStep > 2 ? 'bg-blue-500' : 'bg-slate-200' }} rounded-full"></div>
                    </div>
                    
                    <div class="flex-1 flex items-center">
                        <div class="{{ $currentStep >= 3 ? 'bg-blue-600' : 'bg-slate-200' }} w-8 h-8 flex items-center justify-center rounded-full text-white font-medium">
                            3
                        </div>
                        <div class="ml-3">
                            <p class="{{ $currentStep >= 3 ? 'text-blue-600 font-medium' : 'text-slate-500' }} text-sm">
                                Kontak & Foto
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="max-w-3xl mx-auto px-4 pt-6 pb-8">
            @if(!$previewMode)
                <!-- Step 1: Basic Information -->
                <div class="{{ $currentStep === 1 ? 'block' : 'hidden' }}">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">Informasi Dasar</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <label for="nip" class="block text-sm font-medium text-slate-700 mb-1">NIP</label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="nip" 
                                    wire:model="nip" 
                                    class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-slate-100 disabled:cursor-not-allowed" 
                                    readonly
                                />
                                <div class="absolute right-3 top-2.5 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                </div>
                            </div>
                            @error('nip') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="col-span-1">
                            <label for="nama" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input 
                                type="text" 
                                id="nama" 
                                wire:model="nama" 
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" 
                                placeholder="Masukkan nama lengkap"
                            />
                            @error('nama') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="col-span-1 md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute left-3 top-2.5 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input 
                                    type="email" 
                                    id="email" 
                                    wire:model="email" 
                                    class="w-full rounded-lg border border-slate-200 pl-10 pr-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" 
                                    placeholder="Masukkan email"
                                />
                            </div>
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    
                        <div class="col-span-1">
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                                Password @if(!$isEditMode)<span class="text-red-500">*</span>@endif
                                @if($isEditMode)
                                <span class="text-xs font-normal text-slate-500">(Biarkan kosong jika tidak ingin mengubah)</span>
                                @endif
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password" 
                                    wire:model="password" 
                                    class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" 
                                    placeholder="{{ $isEditMode ? 'Biarkan kosong jika tidak ingin mengubah' : 'Masukkan password' }}"
                                />
                                <div class="absolute right-3 top-2.5 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    
                        <div class="col-span-1">
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">
                                Konfirmasi Password @if(!$isEditMode)<span class="text-red-500">*</span>@endif
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    wire:model="password_confirmation" 
                                    class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" 
                                    placeholder="Konfirmasi password"
                                />
                                <div class="absolute right-3 top-2.5 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            @error('password_confirmation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Step 2: Employment Information -->
                <div class="{{ $currentStep === 2 ? 'block' : 'hidden' }}">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">Informasi Kepegawaian</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <label for="jabatan_id" class="block text-sm font-medium text-slate-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                            <select 
                                id="jabatan_id" 
                                wire:model="jabatan_id" 
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Pilih Jabatan</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                                @endforeach
                            </select>
                            @error('jabatan_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="col-span-1">
                            <label for="unit_kerja_id" class="block text-sm font-medium text-slate-700 mb-1">Unit Kerja / Departemen <span class="text-red-500">*</span></label>
                            <select 
                                id="unit_kerja_id" 
                                wire:model="unit_kerja_id" 
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Pilih Unit Kerja</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->nama_unit }}</option>
                                @endforeach
                            </select>
                            @error('unit_kerja_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="col-span-1 md:col-span-2">
                            <label for="gaji_pokok" class="block text-sm font-medium text-slate-700 mb-1">Gaji Pokok <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute left-3 top-2.5 text-slate-500 font-medium">
                                    Rp
                                </div>
                                <input 
                                    type="number" 
                                    id="gaji_pokok" 
                                    wire:model="gaji_pokok" 
                                    class="w-full rounded-lg border border-slate-200 pl-10 pr-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" 
                                    placeholder="0"
                                    min="0"
                                    step="100000"
                                />
                            </div>
                            @error('gaji_pokok') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            
                            <p class="mt-2 text-xs text-slate-500">
                                Format angka, contoh: 4500000 untuk empat juta lima ratus ribu rupiah
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Contact & Photo -->
                <div class="{{ $currentStep === 3 ? 'block' : 'hidden' }}">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">Kontak & Foto</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <label for="no_telp" class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon</label>
                            <div class="relative">
                                <div class="absolute left-3 top-2.5 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="no_telp" 
                                    wire:model="no_telp" 
                                    class="w-full rounded-lg border border-slate-200 pl-10 pr-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" 
                                    placeholder="Masukkan nomor telepon"
                                />
                            </div>
                            @error('no_telp') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="col-span-1 md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1">Alamat</label>
                            <textarea 
                                id="alamat" 
                                wire:model="alamat" 
                                rows="3" 
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" 
                                placeholder="Masukkan alamat lengkap"
                            ></textarea>
                            @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Foto Profil</label>
                            <div 
                                x-data="{ 
                                    isUploading: false,
                                    progress: 0,
                                    previewUrl: '{{ $isEditMode && $temp_foto_profil ? asset('storage/profile-photos/'. $temp_foto_profil) : '' }}',
                                }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false; previewUrl = $event.detail.temporaryUrl;"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <div class="flex items-center space-x-4">
                                    <div class="w-24 h-24 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center">
                                        <template x-if="previewUrl">
                                            <img :src="previewUrl" class="w-full h-full object-cover" />
                                        </template>
                                        <template x-if="!previewUrl">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </template>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <label for="foto_profil" class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 cursor-pointer inline-block">
                                                Pilih Foto
                                            </label>
                                            @if($isEditMode && $temp_foto_profil)
                                                <button type="button" class="ml-3 text-sm text-red-600 hover:text-red-800" wire:click="$set('foto_profil', null)">
                                                    Hapus
                                                </button>
                                            @endif
                                        </div>
                                        <input type="file" wire:model="foto_profil" id="foto_profil" class="hidden" accept="image/*" />
                                        <p class="text-xs text-slate-500 mt-1">PNG, JPG atau JPEG. Maksimal 1MB.</p>
                                        
                                        <div x-show="isUploading" class="mt-2">
                                            <div class="w-full bg-slate-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" :style="`width: ${progress}%`"></div>
                                            </div>
                                            <p class="text-xs text-slate-500 mt-1" x-text="`Uploading: ${progress}%`"></p>
                                        </div>
                                    </div>
                                </div>
                                @error('foto_profil') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Preview Mode -->
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-200 mb-6">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Pratinjau Data
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center">
                                <div class="w-20 h-20 rounded-full bg-slate-100 overflow-hidden border-4 border-white shadow-md">
                                    @if($foto_profil)
                                        <img src="{{ $foto_profil->temporaryUrl() }}" alt="Preview" class="w-full h-full object-cover">
                                    @elseif($isEditMode && $temp_foto_profil)
                                        <img src="{{ asset('storage/profile-photos/'.$temp_foto_profil) }}" alt="{{ $nama }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-600 text-white text-xl font-bold">
                                            {{ $nama ? substr($nama, 0, 1) : 'U' }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-slate-800">{{ $nama ?: 'Nama Belum Diisi' }}</h4>
                                    <p class="text-blue-600 text-sm font-medium">
                                        {{ $jabatanNama ?: 'Jabatan Belum Dipilih' }}
                                    </p>
                                    <p class="text-slate-500 text-sm">
                                        {{ $unitKerjaNama ?: 'Unit Kerja Belum Dipilih' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-3">Informasi Pribadi</h3>
                            <dl class="space-y-2">
                                <div class="grid grid-cols-5 gap-1">
                                    <dt class="text-sm font-medium text-slate-500 col-span-2">NIP</dt>
                                    <dd class="text-sm text-slate-800 col-span-3">{{ $nip ?: '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-5 gap-1">
                                    <dt class="text-sm font-medium text-slate-500 col-span-2">Nama Lengkap</dt>
                                    <dd class="text-sm text-slate-800 col-span-3">{{ $nama ?: '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-5 gap-1">
                                    <dt class="text-sm font-medium text-slate-500 col-span-2">Email</dt>
                                    <dd class="text-sm text-slate-800 col-span-3">{{ $email ?: '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-5 gap-1">
                                    <dt class="text-sm font-medium text-slate-500 col-span-2">No. Telepon</dt>
                                    <dd class="text-sm text-slate-800 col-span-3">{{ $no_telp ?: '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-5 gap-1">
                                    <dt class="text-sm font-medium text-slate-500 col-span-2">Alamat</dt>
                                    <dd class="text-sm text-slate-800 col-span-3">{{ $alamat ?: '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                        
                        <div>
                            <h3 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-3">Informasi Kepegawaian</h3>
                            <dl class="space-y-2">
                                <div class="grid grid-cols-5 gap-1">
                                    <dt class="text-sm font-medium text-slate-500 col-span-2">Unit Kerja</dt>
                                    <dd class="text-sm text-slate-800 col-span-3">{{ $unitKerjaNama ?: '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-5 gap-1">
                                    <dt class="text-sm font-medium text-slate-500 col-span-2">Jabatan</dt>
                                    <dd class="text-sm text-slate-800 col-span-3">{{ $jabatanNama ?: '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-5 gap-1">
                                    <dt class="text-sm font-medium text-slate-500 col-span-2">Gaji Pokok</dt>
                                    <dd class="text-sm text-slate-800 col-span-3">
                                        @if($gaji_pokok)
                                            Rp {{ number_format($gaji_pokok, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-sm italic text-slate-500">
                            Pastikan semua data sudah benar sebelum menyimpan
                        </p>
                        <button 
                            wire:click="togglePreview" 
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Kembali ke Form
                        </button>
                    </div>
                </div>
            @endif
            
            <!-- Form Navigation -->
            <div class="mt-8 flex justify-between">
                @if($currentStep > 1 && !$previewMode)
                    <button 
                        type="button"
                        wire:click="previousStep"
                        class="px-4 py-2.5 border border-slate-200 rounded-xl text-slate-700 font-medium hover:bg-slate-50 flex items-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Sebelumnya
                    </button>
                @else
                    <div></div>
                @endif
                
                @if($currentStep < $totalSteps && !$previewMode)
                    <button 
                        type="button"
                        wire:click="nextStep"
                        class="px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl font-medium shadow-sm hover:shadow flex items-center"
                    >
                        Selanjutnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @elseif($currentStep === $totalSteps && !$previewMode)
                    <div class="space-x-3">
                        <button 
                            type="button"
                            wire:click="togglePreview"
                            class="px-4 py-2.5 border border-blue-200 bg-blue-50 rounded-xl text-blue-700 font-medium hover:bg-blue-100 flex items-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Pratinjau
                        </button>
                    </div>
                @elseif($previewMode)
                    <button 
                        type="button"
                        wire:click="save"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl font-medium shadow-sm hover:shadow flex items-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Pegawai' }}
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>