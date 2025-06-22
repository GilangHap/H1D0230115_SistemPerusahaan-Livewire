<?php

namespace App\Livewire\Position;

use App\Models\Role;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class ManagePosition extends Component
{
    use WithPagination;
    #[Layout('livewire.layouts.app-layout')]
    // Search & Filter
    public $search = '';
    public $filterRole = '';
    public $sortField = 'nama_jabatan';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
    // View options
    public $viewMode = 'grid'; // 'grid' or 'table'
    
    // Selected position for action
    public $selectedPosition = null;
    public $isConfirmingDelete = false;
    public $positionToDelete = null;
    
    protected function getListeners()
    {
        return [
            'positionAdded' => 'handlePositionAdded',
            'positionUpdated' => 'handlePositionUpdated',
            'deletePosition' => 'deletePosition'
        ];
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function updatedFilterRole()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        
        $this->resetPage();
    }
    
    public function switchViewMode($mode)
    {
        $this->viewMode = $mode;
    }
    
    public function confirmDelete($positionId)
    {
        $this->positionToDelete = $positionId;
        $this->selectedPosition = Jabatan::with('pegawais')->find($positionId);
        $this->isConfirmingDelete = true;
    }
    
    public function deletePosition($data = null)
    {
        // If data is passed from the header modal
        if ($data && isset($data['positionId'])) {
            $this->positionToDelete = $data['positionId'];
        }
        
        try {
            $position = Jabatan::find($this->positionToDelete);
            
            if ($position) {
                // Check if position has employees
                $employeeCount = $position->pegawais->count();
                
                // Capture name before delete for message
                $posName = $position->nama_jabatan;
                
                // Delete the position - this should cascade delete or handle constraints
                // based on your database configuration
                $position->delete();
                
                $this->dispatch('swal:modal', [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => "Jabatan $posName berhasil dihapus" . 
                              ($employeeCount > 0 ? " (berhati-hatilah, ada $employeeCount pegawai dengan jabatan ini)." : ".")
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => "Gagal menghapus jabatan: " . $e->getMessage()
            ]);
        }
        
        $this->positionToDelete = null;
        $this->selectedPosition = null;
        $this->isConfirmingDelete = false;
    }
    
    public function handlePositionAdded($message)
    {
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => $message
        ]);
    }
    
    public function handlePositionUpdated($message)
    {
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => $message
        ]);
    }
    
    public function render()
    {
        $positionsQuery = Jabatan::query()
            ->with('role', 'pegawais')
            ->when($this->search, function ($query) {
                $query->where('nama_jabatan', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterRole, function ($query) {
                $query->where('role_id', $this->filterRole);
            })
            ->orderBy($this->sortField, $this->sortDirection);
        
        $positions = $positionsQuery->paginate($this->perPage);
        
        $roles = Role::orderBy('name')->get();
        
        // Get statistics
        $stats = [
            'total' => Jabatan::count(),
            'with_employees' => Jabatan::whereHas('pegawais')->count(),
            'by_role' => Jabatan::selectRaw('role_id, count(*) as count')
                ->groupBy('role_id')
                ->with('role')
                ->get()
        ];
        
        return view('livewire.position.manage-position', [
            'positions' => $positions,
            'roles' => $roles,
            'stats' => $stats
        ]);
    }
}
