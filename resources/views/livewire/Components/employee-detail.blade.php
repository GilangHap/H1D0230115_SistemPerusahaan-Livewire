<div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-6">
    @if($employee)
        <!-- Left Column: Profile Overview -->
        <div class="md:col-span-1">
            <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl p-6 text-center border border-blue-100/30 shadow-sm">
                <div class="w-28 h-28 rounded-full mx-auto overflow-hidden bg-slate-100 mb-4 ring-4 ring-white shadow-md">
                    @if($employee->foto_profil)
                        <img src="{{ asset('storage/profile-photos/' . $employee->foto_profil) }}" alt="{{ $employee->nama }}" class="h-full w-full object-cover">
                    @else
                        <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-600 text-white text-3xl font-bold">
                            {{ substr($employee->nama, 0, 1) }}
                        </div>
                    @endif
                </div>
                
                <h4 class="text-lg font-bold text-slate-800">{{ $employee->nama }}</h4>
                <p class="text-blue-600 text-sm font-medium mt-1">
                    {{ $employee->jabatan ? $employee->jabatan->nama_jabatan : 'Tidak ada jabatan' }}
                </p>
                <p class="text-slate-500 text-sm mt-1">
                    {{ $employee->unitKerja ? $employee->unitKerja->nama_unit : 'Tidak ada departemen' }}
                </p>
                
                <div class="mt-4 text-sm">
                    <div class="bg-blue-50 text-blue-700 rounded-lg py-2 px-3 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        {{ $employee->nip }}
                    </div>
                </div>
            </div>
            
            <div class="mt-4 flex flex-col gap-2">
                <a 
                    href="{{ route('admin.employee.edit', ['id' => $employee->id]) }}"
                    class="w-full py-2.5 flex justify-center items-center text-sm font-medium bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl transition-all shadow-sm hover:shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data Pegawai
                </a>
                <button 
                    x-data="{}"
                    @click="
                        $dispatch('close-employee-detail');
                        $dispatch('open-header-modal', { 
                            title: 'Hapus Pegawai',
                            message: 'Apakah Anda yakin ingin menghapus pegawai ini? Data yang telah dihapus tidak dapat dikembalikan.',
                            confirmText: 'Hapus',
                            cancelText: 'Batal',
                            confirmAction: 'deleteEmployee',
                            employeeId: {{ $employee->id }}
                        });
                    "
                    class="w-full py-2.5 flex justify-center items-center text-sm font-medium bg-white hover:bg-red-50 text-red-600 hover:text-red-700 border border-red-200 rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus Pegawai
                </button>
            </div>
        </div>
        
        <!-- Right Column: Detail Tabs -->
        <div class="md:col-span-2">
            <!-- Tab Navigation -->
            <div class="border-b border-slate-200 mb-6">
                <nav class="-mb-px flex space-x-6">
                    <button 
                        wire:click="changeTab('profile')" 
                        class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $selectedTab === 'profile' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                        Informasi Dasar
                    </button>
                    <button 
                        wire:click="changeTab('employment')" 
                        class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $selectedTab === 'employment' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                        Informasi Kepegawaian
                    </button>
                    <button 
                        wire:click="changeTab('contact')" 
                        class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $selectedTab === 'contact' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                        Kontak & Alamat
                    </button>
                </nav>
            </div>
            
            <!-- Tab Content -->
            
            <!-- Profile Tab -->
            <div class="{{ $selectedTab === 'profile' ? 'block' : 'hidden' }} space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Nama Lengkap</h4>
                        <p class="text-base text-slate-800 font-medium">{{ $employee->nama }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">NIP</h4>
                        <p class="text-base text-slate-800 font-medium">{{ $employee->nip }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Email</h4>
                        <p class="text-base text-slate-800 font-medium">{{ $employee->email }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Tanggal Lahir</h4>
                        <p class="text-base text-slate-800 font-medium">
                            {{ $employee->tanggal_lahir ? \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Jenis Kelamin</h4>
                        <p class="text-base text-slate-800 font-medium">
                            @if($employee->jenis_kelamin === 'L')
                                <span class="inline-flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                                    Laki-laki
                                </span>
                            @elseif($employee->jenis_kelamin === 'P')
                                <span class="inline-flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-pink-500 mr-2"></span>
                                    Perempuan
                                </span>
                            @else
                                <span class="text-slate-400">Tidak diketahui</span>
                            @endif
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">NIK</h4>
                        <p class="text-base text-slate-800 font-medium">{{ $employee->nik ?? '-' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Employment Tab -->
            <div class="{{ $selectedTab === 'employment' ? 'block' : 'hidden' }} space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Departemen</h4>
                        <p class="text-base text-slate-800 font-medium">
                            @if($employee->unitKerja)
                                <span class="inline-flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-purple-400 mr-2"></span>
                                    {{ $employee->unitKerja->nama_unit }}
                                </span>
                            @else
                                <span class="text-slate-400">Tidak ditetapkan</span>
                            @endif
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Jabatan</h4>
                        <p class="text-base text-slate-800 font-medium">
                            @if($employee->jabatan)
                                <span class="inline-flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-blue-400 mr-2"></span>
                                    {{ $employee->jabatan->nama_jabatan }}
                                </span>
                            @else
                                <span class="text-slate-400">Tidak ditetapkan</span>
                            @endif
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Tanggal Bergabung</h4>
                        <p class="text-base text-slate-800 font-medium">{{ $employee->tanggal_bergabung ? \Carbon\Carbon::parse($employee->tanggal_bergabung)->format('d F Y') : '-' }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Status Kepegawaian</h4>
                        <p class="text-base text-slate-800 font-medium">{{ $employee->status_kepegawaian ?? '-' }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">NPWP</h4>
                        <p class="text-base text-slate-800 font-medium">{{ $employee->npwp ?? '-' }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Nomor BPJS Kesehatan</h4>
                        <p class="text-base text-slate-800 font-medium">{{ $employee->bpjs_kesehatan ?? '-' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Tab -->
            <div class="{{ $selectedTab === 'contact' ? 'block' : 'hidden' }} space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Nomor Telepon</h4>
                        <p class="text-base text-slate-800 font-medium flex items-center">
                            @if($employee->no_telp)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $employee->no_telp }}
                            @else
                                <span class="text-slate-400">Tidak ada</span>
                            @endif
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-all md:col-span-2">
                        <h4 class="text-xs uppercase font-semibold text-slate-400 tracking-wider mb-2">Alamat</h4>
                        <p class="text-base text-slate-800 font-medium flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            @if($employee->alamat)
                                {{ $employee->alamat }}
                            @else
                                <span class="text-slate-400">Tidak ada</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="md:col-span-3 flex items-center justify-center p-10">
            <div class="text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-700">Data pegawai tidak ditemukan</h3>
                <p class="text-sm text-slate-500 mt-2">Mungkin pegawai telah dihapus atau terjadi kesalahan.</p>
            </div>
        </div>
    @endif
</div>