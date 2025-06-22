<div class="space-y-6">
    @php
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Storage;
    @endphp
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-indigo-100 to-purple-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative z-10">
            <div>
                <div class="flex items-center">
                    @if(Auth::user()->jabatan && Auth::user()->jabatan->role && Auth::user()->jabatan->role->name === 'admin')
                        <button 
                            wire:click="backToDepartmentList" 
                            class="mr-3 p-1 rounded-lg hover:bg-slate-100 transition-colors"
                            title="Kembali ke daftar departemen"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </button>
                    @endif
                    <h1 class="text-xl font-semibold text-slate-800">
                        Anggota Departemen: {{ $departmentName }}
                    </h1>
                </div>
                <p class="text-slate-500 mt-1 ">Daftar pegawai yang termasuk dalam departemen ini</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Cari pegawai..." 
                        class="pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm w-full md:w-[220px]"
                    />
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                
                <select 
                    wire:model.live="filterJabatan"
                    class="py-2.5 px-4 rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                >
                    <option value="">Semua Jabatan</option>
                    @foreach($jabatanList as $jabatan)
                        <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                    @endforeach
                </select>
                
                <button 
                    wire:click="resetFilters"
                    class="p-2.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    title="Reset filter"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Staff Members List -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="align-middle inline-block min-w-full">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Foto
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('nama')">
                                        <div class="flex items-center space-x-1">
                                            <span>Nama</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                @if ($sortField === 'nama')
                                                    @if ($sortDirection === 'asc')
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                    @endif
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4" />
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Jabatan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('email')">
                                        <div class="flex items-center space-x-1">
                                            <span>Email</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                @if ($sortField === 'email')
                                                    @if ($sortDirection === 'asc')
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                    @endif
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4" />
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('no_telp')">
                                        <div class="flex items-center space-x-1">
                                            <span>Telepon</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                @if ($sortField === 'no_telp')
                                                    @if ($sortDirection === 'asc')
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                    @endif
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4" />
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @forelse ($staffMembers as $staff)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-3">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img 
                                                    src="{{ $staff->foto_profil ? Storage::url('profile-photos/' . $staff->foto_profil) : asset('images/default-avatar.svg') }}"
                                                    alt="{{ $staff->nama }}" 
                                                    class="h-10 w-10 rounded-full object-cover border border-slate-200"
                                                >
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-slate-800">
                                            {{ $staff->nama }}
                                            <div class="text-xs text-slate-500">NIP: {{ $staff->nip }}</div>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-slate-600">
                                            <span class="px-2 py-1 text-xs rounded-full {{ $staff->jabatan && $staff->jabatan->nama_jabatan == 'Manager' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ $staff->jabatan ? $staff->jabatan->nama_jabatan : '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-slate-600">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                {{ $staff->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-slate-600">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                {{ $staff->no_telp ?: '-' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                            <button 
                                                wire:click="showStaffDetail({{ $staff->id }})"
                                                class="text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 p-1 rounded-full transition-colors"
                                                title="Lihat detail pegawai"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-slate-500 italic bg-slate-50">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <span>Tidak ada anggota departemen ditemukan</span>
                                                @if(!empty($search) || !empty($filterJabatan))
                                                    <span class="text-sm text-slate-400 mt-1">Coba ubah filter pencarian</span>
                                                    <button 
                                                        wire:click="resetFilters"
                                                        class="mt-3 text-sm text-indigo-600 hover:text-indigo-800 font-medium"
                                                    >
                                                        Reset Filter
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white border-t border-slate-200 px-4 py-3 sm:px-6">
                {{ $staffMembers->links() }}
            </div>
        </div>
    </div>

    <!-- Staff Detail Modal -->
    @if($showDetailModal && $selectedStaff)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closeDetailModal"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                Detail Pegawai
                            </h3>
                            <button 
                                wire:click="closeDetailModal" 
                                class="text-gray-400 hover:text-gray-500 transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="sm:flex sm:items-start">
                            <!-- Profile Photo -->
                            <div class="sm:mr-6 mb-4 sm:mb-0 flex-shrink-0">
                                <img 
                                    src="{{ $selectedStaff->foto_profil ? Storage::url('profile-photos/' . $selectedStaff->foto_profil) : asset('images/default-avatar.svg') }}"
                                    alt="{{ $selectedStaff->nama }}" 
                                    class="h-32 w-32 rounded-lg object-cover border border-slate-200"
                                >
                            </div>
                            
                            <!-- Staff Information -->
                            <div class="flex-grow">
                                <h4 class="text-xl font-medium text-slate-900">{{ $selectedStaff->nama }}</h4>
                                <p class="text-indigo-600 font-medium mb-3">{{ $selectedStaff->jabatan ? $selectedStaff->jabatan->nama_jabatan : '-' }}</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                                    <div>
                                        <label class="text-xs text-slate-500 block">NIP</label>
                                        <p class="text-slate-800">{{ $selectedStaff->nip ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Departemen</label>
                                        <p class="text-slate-800">{{ $selectedStaff->unitKerja ? $selectedStaff->unitKerja->nama_unit : '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Email</label>
                                        <p class="text-slate-800">{{ $selectedStaff->email ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Telepon</label>
                                        <p class="text-slate-800">{{ $selectedStaff->no_telp ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Alamat</label>
                                        <p class="text-slate-800">{{ $selectedStaff->alamat ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Tanggal Bergabung</label>
                                        <p class="text-slate-800">{{ $selectedStaff->created_at ? date('d F Y', strtotime($selectedStaff->created_at)) : '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            type="button" 
                            wire:click="closeDetailModal" 
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
