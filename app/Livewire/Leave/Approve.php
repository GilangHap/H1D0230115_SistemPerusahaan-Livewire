<?php

namespace App\Livewire\Leave;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Approve extends Component
{
    use WithPagination;
    
    #[Layout('livewire.layouts.app-layout')]
    public $search = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $dateFilter = '';
    
    // Detail modal properties
    public $showDetailModal = false;
    public $selectedLeave = null;
    public $approvalNotes = '';
    public $rejectionReason = '';
    
    // Custom confirmation modals
    public $showApproveConfirmModal = false;
    public $showRejectConfirmModal = false;
    public $leaveIdToProcess = null;
    public $resultMessage = '';
    public $showResultModal = false;
    public $resultType = 'success';
    
    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'dateFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];
    
    protected $rules = [
        'approvalNotes' => 'nullable|string|max:255',
        'rejectionReason' => 'required_if:action,reject|string|max:255',
    ];
    
    protected $messages = [
        'rejectionReason.required_if' => 'Alasan penolakan harus diisi.',
    ];

    public function render()
    {
        $manager = Auth::user();
        $departmentId = $manager->unit_kerja_id;
        
        // Only get leave requests from employees in this manager's department
        $query = Cuti::join('pegawais', 'cutis.pegawai_id', '=', 'pegawais.id')
                      ->where('pegawais.unit_kerja_id', $departmentId)
                      ->select('cutis.*');
        
        // Exclude the manager's own leave requests
        $query->where('cutis.pegawai_id', '!=', $manager->id);
        
        // Apply search filter
        if (!empty($this->search)) {
            $query->whereHas('pegawai', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nip', 'like', '%' . $this->search . '%');
            });
        }
        
        // Apply status filter
        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }
        
        // Apply date filter
        if (!empty($this->dateFilter)) {
            if ($this->dateFilter === 'today') {
                $query->whereDate('tanggal_mulai', Carbon::today())
                      ->orWhereDate('tanggal_akhir', Carbon::today());
            } elseif ($this->dateFilter === 'week') {
                $query->whereBetween('tanggal_mulai', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                      ->orWhereBetween('tanggal_akhir', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($this->dateFilter === 'month') {
                $query->whereMonth('tanggal_mulai', Carbon::now()->month)
                      ->orWhereMonth('tanggal_akhir', Carbon::now()->month);
            }
        }
        
        // Apply sorting
        $leaveRequests = $query->orderBy($this->sortField, $this->sortDirection)
                            ->with(['pegawai', 'pegawai.jabatan'])
                            ->paginate($this->perPage);
        
        // Get counts for badges
        $pendingCount = Cuti::join('pegawais', 'cutis.pegawai_id', '=', 'pegawais.id')
                            ->where('pegawais.unit_kerja_id', $departmentId)
                            ->where('cutis.pegawai_id', '!=', $manager->id)
                            ->where('status', 'pending')
                            ->count();
        
        return view('livewire.leave.approve', [
            'leaveRequests' => $leaveRequests,
            'pendingCount' => $pendingCount
        ]);
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function resetFilters()
    {
        $this->reset(['search', 'statusFilter', 'dateFilter', 'sortField', 'sortDirection']);
        $this->resetPage();
    }
    
    public function showLeaveDetail($id)
    {
        $manager = Auth::user();
        $departmentId = $manager->unit_kerja_id;
        
        // Modified query to fix the relationship issue
        $leave = Cuti::with(['pegawai', 'pegawai.jabatan', 'pegawai.unitKerja'])
                    ->where('id', $id)
                    ->whereHas('pegawai', function ($q) use ($departmentId) {
                        $q->where('unit_kerja_id', $departmentId);
                    })
                    ->first();
        
        if (!$leave) {
            $this->showErrorMessage('Data cuti tidak ditemukan atau Anda tidak memiliki akses.');
            return;
        }
        
        $this->selectedLeave = $leave;
        $this->showDetailModal = true;
    }
    
    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedLeave = null;
        $this->reset(['approvalNotes', 'rejectionReason']);
    }
    
    public function showApproveModal($leaveId)
    {
        $this->leaveIdToProcess = $leaveId;
        $this->showApproveConfirmModal = true;
    }
    
    public function showRejectModal($leaveId)
    {
        // Validate rejection reason first
        $this->validate([
            'rejectionReason' => 'required|string|min:3|max:255',
        ]);
        
        $this->leaveIdToProcess = $leaveId;
        $this->showRejectConfirmModal = true;
    }
    
    public function closeConfirmModals()
    {
        $this->showApproveConfirmModal = false;
        $this->showRejectConfirmModal = false;
        $this->leaveIdToProcess = null;
    }
    
    public function approveLeave()
    {
        $manager = Auth::user();
        $departmentId = $manager->unit_kerja_id;
        
        // Modified query to fix the issue
        $leave = Cuti::where('id', $this->leaveIdToProcess)
                    ->whereHas('pegawai', function ($q) use ($departmentId) {
                        $q->where('unit_kerja_id', $departmentId);
                    })
                    ->first();
        
        if (!$leave) {
            $this->showErrorMessage('Data cuti tidak ditemukan atau Anda tidak memiliki akses.');
            return;
        }
        
        if ($leave->status !== 'pending') {
            $this->showErrorMessage('Pengajuan cuti ini sudah diproses sebelumnya.');
            return;
        }
        
        try {
            $leave->status = 'approved';
            $leave->approved_by = $manager->id;
            $leave->catatan = $this->approvalNotes;
            $leave->save();
            
            // Close all modals
            $this->closeAllModals();
            
            // Show success message
            $this->showSuccessMessage('Pengajuan cuti berhasil disetujui.');
            
        } catch (\Exception $e) {
            $this->showErrorMessage('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function rejectLeave()
    {
        $manager = Auth::user();
        $departmentId = $manager->unit_kerja_id;
        
        // Modified query to fix the issue
        $leave = Cuti::where('id', $this->leaveIdToProcess)
                    ->whereHas('pegawai', function ($q) use ($departmentId) {
                        $q->where('unit_kerja_id', $departmentId);
                    })
                    ->first();
        
        if (!$leave) {
            $this->showErrorMessage('Data cuti tidak ditemukan atau Anda tidak memiliki akses.');
            return;
        }
        
        if ($leave->status !== 'pending') {
            $this->showErrorMessage('Pengajuan cuti ini sudah diproses sebelumnya.');
            return;
        }
        
        try {
            $leave->status = 'rejected';
            $leave->approved_by = $manager->id;
            $leave->catatan = $this->rejectionReason;
            $leave->save();
            
            // Close all modals
            $this->closeAllModals();
            
            // Show success message
            $this->showSuccessMessage('Pengajuan cuti berhasil ditolak.');
            
        } catch (\Exception $e) {
            $this->showErrorMessage('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function closeAllModals()
    {
        $this->showDetailModal = false;
        $this->showApproveConfirmModal = false;
        $this->showRejectConfirmModal = false;
        $this->selectedLeave = null;
        $this->leaveIdToProcess = null;
        $this->reset(['approvalNotes', 'rejectionReason']);
    }
    
    public function showSuccessMessage($message)
    {
        $this->resultMessage = $message;
        $this->resultType = 'success';
        $this->showResultModal = true;
    }
    
    public function showErrorMessage($message)
    {
        $this->resultMessage = $message;
        $this->resultType = 'error';
        $this->showResultModal = true;
    }
    
    public function closeResultModal()
    {
        $this->showResultModal = false;
        $this->resultMessage = '';
    }
}
