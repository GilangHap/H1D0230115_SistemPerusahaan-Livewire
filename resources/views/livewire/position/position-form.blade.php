<div class="py-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 flex items-center">
                <span class="bg-purple-600/10 text-purple-600 p-1.5 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        @if($isEditMode)
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        @else
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        @endif
                    </svg>
                </span>
                {{ $isEditMode ? "Edit Jabatan" : "Tambah Jabatan Baru" }}
            </h1>
            <p class="mt-1 text-sm text-slate-600">
                {{ $isEditMode ? "Perbarui informasi jabatan yang sudah ada" : "Tambahkan jabatan baru ke dalam sistem" }}
            </p>
        </div>
        
        <div class="mt-4 md:mt-0 flex items-center gap-3">
            <a href="{{ route('position.manage') }}" wire:navigate class="flex items-center justify-center px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl shadow-sm hover:bg-slate-50 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
    </div>
    
    <!-- Form Card -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
            <!-- Form Header with Gradient -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 py-6 px-6 md:px-10 relative">
                <h2 class="text-lg font-semibold text-white">Formulir Jabatan</h2>
                <p class="text-sm text-white/80 mt-1">Isi data jabatan dengan lengkap</p>
                
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 mt-6 mr-6 text-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            
            <!-- Form Content -->
            <form wire:submit.prevent="save" class="p-6 md:p-10 space-y-6">
                <div>
                    <label for="nama_jabatan" class="block text-sm font-medium text-slate-700 mb-1">Nama Jabatan <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="nama_jabatan" 
                        wire:model="nama_jabatan" 
                        class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-purple-500 focus:ring-purple-500" 
                        placeholder="Masukkan nama jabatan"
                    />
                    @error('nama_jabatan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="role_id" class="block text-sm font-medium text-slate-700 mb-1">Role <span class="text-red-500">*</span></label>
                    <select 
                        id="role_id" 
                        wire:model="role_id" 
                        class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-purple-500 focus:ring-purple-500"
                    >
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    <p class="mt-1 text-xs text-slate-500">Role menentukan hak akses pengguna dalam sistem</p>
                </div>
                
                <div>
                    <label for="tunjangan" class="block text-sm font-medium text-slate-700 mb-1">Tunjangan Jabatan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-slate-500">Rp</span>
                        </div>
                        <input 
                            type="number" 
                            id="tunjangan" 
                            wire:model="tunjangan" 
                            class="w-full rounded-lg border border-slate-200 pl-10 px-4 py-2.5 text-sm focus:border-purple-500 focus:ring-purple-500" 
                            placeholder="0"
                            min="0"
                            step="10000"
                        />
                    </div>
                    @error('tunjangan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    <p class="mt-1 text-xs text-slate-500">Tunjangan yang diberikan kepada pemegang jabatan ini per bulan</p>
                </div>
                
                <div class="pt-4 border-t border-slate-200/60 flex justify-end gap-3">
                    <a href="{{ route('position.manage') }}" class="px-4 py-2.5 border border-slate-300 rounded-lg text-slate-700 font-medium hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg font-medium shadow-sm hover:shadow transition-all">
                        <span class="flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ $isEditMode ? 'Perbarui Jabatan' : 'Simpan Jabatan' }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>