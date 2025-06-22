<!-- filepath: d:\laragon\www\Sistem-Perusahaan\resources\views\livewire\departement\departement-form.blade.php -->
<div class="py-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 flex items-center">
                <span class="bg-indigo-600/10 text-indigo-600 p-1.5 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        @if($isEditMode)
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        @else
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        @endif
                    </svg>
                </span>
                {{ $isEditMode ? "Edit Departemen" : "Tambah Departemen Baru" }}
            </h1>
            <p class="mt-1 text-sm text-slate-600">
                {{ $isEditMode ? "Perbarui informasi departemen yang sudah ada" : "Tambahkan departemen atau unit kerja baru" }}
            </p>
        </div>
        
        <div class="mt-4 md:mt-0 flex items-center gap-3">
            <a href="{{ route('departement.manage') }}" wire:navigate class="flex items-center justify-center px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl shadow-sm hover:bg-slate-50 transition-all duration-200">
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
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-6 px-6 md:px-10 relative">
                <h2 class="text-lg font-semibold text-white">Formulir Departemen</h2>
                <p class="text-sm text-white/80 mt-1">Isi data departemen dengan lengkap</p>
                
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 mt-6 mr-6 text-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
            
            <!-- Form Content -->
            <form wire:submit.prevent="save" class="p-6 md:p-10 space-y-6">
                <div>
                    <label for="nama_unit" class="block text-sm font-medium text-slate-700 mb-1">Nama Departemen <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="nama_unit" 
                        wire:model="nama_unit" 
                        class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        placeholder="Masukkan nama departemen"
                    />
                    @error('nama_unit') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-slate-700 mb-1">Lokasi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="lokasi" 
                            wire:model="lokasi" 
                            class="w-full rounded-lg border border-slate-200 pl-10 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500" 
                            placeholder="Masukkan lokasi departemen"
                        />
                    </div>
                    @error('lokasi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div class="pt-4 border-t border-slate-200/60 flex justify-end gap-3">
                    <a href="{{ route('departement.manage') }}" wire:navigate class="px-4 py-2.5 border border-slate-300 rounded-lg text-slate-700 font-medium hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-medium shadow-sm hover:shadow transition-all">
                        <span class="flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ $isEditMode ? 'Perbarui Departemen' : 'Simpan Departemen' }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>