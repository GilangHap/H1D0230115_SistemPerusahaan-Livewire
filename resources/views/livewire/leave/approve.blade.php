<div class="space-y-6">
    <!-- Header Section with Enhanced Styling -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden">
        <!-- Decorative background element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full opacity-70 blur-xl"></div>
        <div class="absolute -bottom-20 -left-12 w-40 h-40 bg-gradient-to-tr from-emerald-100 to-teal-100 rounded-full opacity-50 blur-xl"></div>
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-xl font-semibold text-slate-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Persetujuan Cuti
                </h1>
                <p class="text-slate-500 mt-1 pl-8">Kelola pengajuan cuti dari anggota departemen Anda</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Cari nama/NIP..." 
                        class="pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm w-full md:w-[260px]"
                    />
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                
                <button 
                    wire:click="resetFilters"
                    class="p-2.5 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                    title="Reset filter"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Filter and Stats Section -->
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Stats Cards -->
        <div class="flex items-center p-4 bg-white rounded-xl shadow-sm border border-slate-200/60 flex-grow">
            <div class="flex gap-4 w-full">
                <div class="flex items-center py-2 px-4 rounded-lg bg-emerald-100 text-emerald-800">
                    <span class="text-xs font-medium">Menunggu Persetujuan</span>
                    <span class="ml-2 py-1 px-2.5 text-xs font-semibold rounded-full bg-emerald-200">{{ $pendingCount }}</span>
                </div>
                
                <div class="border-l border-slate-200 h-10"></div>
                
                <!-- Filter Options -->
                <div class="flex flex-wrap gap-2">
                    <select 
                        wire:model.live="statusFilter"
                        class="py-2 px-3 rounded-lg border border-slate-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-xs"
                    >
                        <option value="">Semua Status</option>
                        <option value="pending">Menunggu</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                        <option value="canceled">Dibatalkan</option>
                    </select>
                    
                    <select 
                        wire:model.live="dateFilter"
                        class="py-2 px-3 rounded-lg border border-slate-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-xs"
                    >
                        <option value="">Semua Tanggal</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Leave Requests Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="align-middle inline-block min-w-full">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Pegawai
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('tanggal_mulai')">
                                        <div class="flex items-center space-x-1">
                                            <span>Tanggal Cuti</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Lama Cuti
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('created_at')">
                                        <div class="flex items-center space-x-1">
                                            <span>Diajukan</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @forelse ($leaveRequests as $leave)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-9 w-9">
                                                    <img 
                                                        src="{{ $leave->pegawai->foto_profil ? Storage::url('profile-photos/' . $leave->pegawai->foto_profil) : asset('images/default-avatar.svg') }}"
                                                        alt="{{ $leave->pegawai->nama }}" 
                                                        class="h-9 w-9 rounded-full object-cover border border-slate-200"
                                                    >
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-slate-800">{{ $leave->pegawai->nama }}</p>
                                                    <div class="text-xs text-slate-500 flex items-center">
                                                        <span class="mr-2">{{ $leave->pegawai->nip }}</span>
                                                        @if($leave->pegawai->jabatan)
                                                            <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700">
                                                                {{ $leave->pegawai->jabatan->nama_jabatan }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            <div class="flex flex-col">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>{{ \Carbon\Carbon::parse($leave->tanggal_mulai)->format('d M Y') }}</span>
                                                </div>
                                                <div class="flex items-center mt-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>{{ \Carbon\Carbon::parse($leave->tanggal_akhir)->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-700">
                                                {{ $leave->jumlah_hari }} hari
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                            {{ \Carbon\Carbon::parse($leave->created_at)->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($leave->status === 'pending')
                                                <span class="px-2.5 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-medium">
                                                    Menunggu
                                                </span>
                                            @elseif($leave->status === 'approved')
                                                <span class="px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium">
                                                    Disetujui
                                                </span>
                                            @elseif($leave->status === 'rejected')
                                                <span class="px-2.5 py-1 rounded-full bg-red-50 text-red-700 text-xs font-medium">
                                                    Ditolak
                                                </span>
                                            @elseif($leave->status === 'canceled')
                                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-medium">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button 
                                                wire:click="showLeaveDetail({{ $leave->id }})"
                                                class="text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 p-1 rounded-full transition-colors"
                                                title="Lihat detail cuti"
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
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>Tidak ada pengajuan cuti ditemukan</span>
                                                @if(!empty($search) || !empty($statusFilter) || !empty($dateFilter))
                                                    <span class="text-sm text-slate-400 mt-1">Coba ubah filter pencarian</span>
                                                    <button 
                                                        wire:click="resetFilters"
                                                        class="mt-3 text-sm text-emerald-600 hover:text-emerald-800 font-medium"
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
                {{ $leaveRequests->links() }}
            </div>
        </div>
    </div>

    <!-- Leave Detail Modal -->
    @if($showDetailModal && $selectedLeave)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeDetailModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                Detail Pengajuan Cuti
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
                            <!-- Employee Info -->
                            <div class="sm:mr-6 mb-4 sm:mb-0 flex-shrink-0">
                                <img 
                                    src="{{ $selectedLeave->pegawai->foto_profil ? Storage::url('profile-photos/' . $selectedLeave->pegawai->foto_profil) : asset('images/default-avatar.svg') }}"
                                    alt="{{ $selectedLeave->pegawai->nama }}" 
                                    class="h-24 w-24 rounded-lg object-cover border border-slate-200"
                                >
                                <div class="mt-2 text-center">
                                    <h4 class="text-sm font-medium text-slate-900">{{ $selectedLeave->pegawai->nama }}</h4>
                                    <p class="text-xs text-slate-500">{{ $selectedLeave->pegawai->nip }}</p>
                                </div>
                            </div>
                            
                            <!-- Leave Details -->
                            <div class="flex-grow">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                                    <div>
                                        <label class="text-xs text-slate-500 block">Jabatan</label>
                                        <p class="text-slate-800">{{ $selectedLeave->pegawai->jabatan ? $selectedLeave->pegawai->jabatan->nama_jabatan : '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Departemen</label>
                                        <p class="text-slate-800">{{ $selectedLeave->pegawai->unitKerja ? $selectedLeave->pegawai->unitKerja->nama_unit : '-' }}</p>
                                    </div>
                                    
                                    <div class="col-span-2">
                                        <div class="border-t border-slate-200 my-2"></div>
                                    </div>
                                    
                                    <div>
                                        <label class="text-xs text-slate-500 block">Tanggal Mulai</label>
                                        <p class="text-slate-800">{{ \Carbon\Carbon::parse($selectedLeave->tanggal_mulai)->format('d F Y') }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Tanggal Akhir</label>
                                        <p class="text-slate-800">{{ \Carbon\Carbon::parse($selectedLeave->tanggal_akhir)->format('d F Y') }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Jumlah Hari</label>
                                        <p class="text-slate-800">{{ $selectedLeave->jumlah_hari }} hari</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Status</label>
                                        <p>
                                            @if($selectedLeave->status === 'pending')
                                                <span class="px-2.5 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-medium">
                                                    Menunggu
                                                </span>
                                            @elseif($selectedLeave->status === 'approved')
                                                <span class="px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium">
                                                    Disetujui
                                                </span>
                                            @elseif($selectedLeave->status === 'rejected')
                                                <span class="px-2.5 py-1 rounded-full bg-red-50 text-red-700 text-xs font-medium">
                                                    Ditolak
                                                </span>
                                            @elseif($selectedLeave->status === 'canceled')
                                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-medium">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                    
                                    <div class="col-span-2">
                                        <label class="text-xs text-slate-500 block">Alasan Cuti</label>
                                        <p class="text-slate-800 whitespace-pre-line">{{ $selectedLeave->alasan }}</p>
                                    </div>
                                    
                                    <!-- Show approval action section only if status is pending -->
                                    @if($selectedLeave->status === 'pending')
                                        <div class="col-span-2">
                                            <div class="border-t border-slate-200 my-3"></div>
                                            <div class="bg-slate-50 p-3 rounded-lg mt-2">
                                                <h4 class="font-medium text-sm mb-2">Tindakan Persetujuan</h4>
                                                
                                                <div class="space-y-4">
                                                    <!-- Approval Notes -->
                                                    <div>
                                                        <label for="approvalNotes" class="block text-xs text-slate-600 mb-1">Catatan Persetujuan (opsional)</label>
                                                        <textarea 
                                                            id="approvalNotes"
                                                            wire:model="approvalNotes"
                                                            rows="2"
                                                            class="w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm"
                                                            placeholder="Tambahkan catatan persetujuan jika diperlukan..."
                                                        ></textarea>
                                                    </div>
                                                    
                                                    <div class="flex gap-3 justify-end">
                                                        <button
                                                            wire:click="showApproveModal({{ $selectedLeave->id }})"
                                                            class="py-2 px-4 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                                                        >
                                                            Setujui Cuti
                                                        </button>
                                                    </div>
                                                    
                                                    <!-- Divider -->
                                                    <div class="border-t border-slate-200 my-3"></div>
                                                    
                                                    <!-- Rejection Reason -->
                                                    <div>
                                                        <label for="rejectionReason" class="block text-xs text-slate-600 mb-1">Alasan Penolakan <span class="text-rose-500">*</span></label>
                                                        <textarea 
                                                            id="rejectionReason"
                                                            wire:model="rejectionReason"
                                                            rows="2"
                                                            class="w-full rounded-md shadow-sm focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm {{ $errors->has('rejectionReason') ? 'border-rose-500' : 'border-slate-300' }}"
                                                            placeholder="Berikan alasan mengapa cuti ini ditolak..."
                                                        ></textarea>
                                                        @error('rejectionReason') 
                                                            <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> 
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="flex gap-3 justify-end">
                                                        <button
                                                            wire:click="showRejectModal({{ $selectedLeave->id }})"
                                                            class="py-2 px-4 bg-rose-600 text-white text-sm rounded-lg hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500"
                                                        >
                                                            Tolak Cuti
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Show processing info if already processed -->
                                        <div class="col-span-2">
                                            <div class="border-t border-slate-200 my-3"></div>
                                            
                                            <div class="mt-2">
                                                <label class="text-xs text-slate-500 block">Catatan</label>
                                                <p class="text-slate-800 whitespace-pre-line">{{ $selectedLeave->catatan ?: '-' }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            type="button" 
                            wire:click="closeDetailModal" 
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:w-auto sm:text-sm"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Approve Confirmation Modal -->
    @if($showApproveConfirmModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeConfirmModals"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Konfirmasi Persetujuan
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah Anda yakin ingin menyetujui pengajuan cuti ini?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            type="button" 
                            wire:click="approveLeave" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Ya, Setujui
                        </button>
                        <button 
                            type="button" 
                            wire:click="closeConfirmModals" 
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Reject Confirmation Modal -->
    @if($showRejectConfirmModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeConfirmModals"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Konfirmasi Penolakan
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah Anda yakin ingin menolak pengajuan cuti ini?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            type="button" 
                            wire:click="rejectLeave" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Ya, Tolak
                        </button>
                        <button 
                            type="button" 
                            wire:click="closeConfirmModals" 
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Result Modal (Success/Error) -->
    @if($showResultModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeResultModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            @if($resultType === 'success')
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Berhasil!
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            {{ $resultMessage }}
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Error!
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            {{ $resultMessage }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            type="button" 
                            wire:click="closeResultModal" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:w-auto sm:text-sm"
                        >
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
