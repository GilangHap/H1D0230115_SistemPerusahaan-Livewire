<?php

namespace App\Livewire\Departement;

use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class ManageDepartement extends Component
{
    use WithPagination;
    
    #[Layout('livewire.layouts.app-layout')]
    // Search & Filter
    public $search = '';
    public $sortField = 'nama_unit';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
    // View options
    public $viewMode = 'grid'; // 'grid' or 'table'
    
    // Selected departement for action
    public $selectedDepartement = null;
    public $isConfirmingDelete = false;
    public $departementToDelete = null;
    
    protected function getListeners()
    {
        return [
            'departementAdded' => 'handleDepartementAdded',
            'departementUpdated' => 'handleDepartementUpdated',
            'deleteEmployee' => 'deleteEmployee'
        ];
    }
    
    public function updatedSearch()
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
    }
    
    public function switchViewMode($mode)
    {
        $this->viewMode = $mode;
    }
    
    public function confirmDelete($departementId)
    {
        $this->departementToDelete = $departementId;
        $this->selectedDepartement = UnitKerja::with('pegawai')->find($departementId);
        $this->isConfirmingDelete = true;
    }
    
    public function deleteDepartement($data = null)
    {
        // If data is passed from the header modal
        if ($data && isset($data['departementId'])) {
            $this->departementToDelete = $data['departementId'];
        }
        
        try {
            $departement = UnitKerja::find($this->departementToDelete);
            
            if ($departement) {
                $employeeCount = $departement->pegawai->count();

                $deptName = $departement->nama_unit;
                
                $departement->delete();
                
                $this->dispatch('swal:modal', [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => "$deptName berhasil dihapus" . 
                              ($employeeCount > 0 ? " bersama dengan $employeeCount pegawai terkait." : ".")
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => "Gagal menghapus departemen: " . $e->getMessage()
            ]);
        }
        
        $this->departementToDelete = null;
        $this->selectedDepartement = null;
        $this->isConfirmingDelete = false;
    }
    
    public function handleDepartementAdded($message)
    {
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => $message,
            'icon' => 'success',
        ]);
    }
    
    public function handleDepartementUpdated($message)
    {
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => $message,
            'icon' => 'success',
        ]);
    }
    
    public function render()
    {
        $query = UnitKerja::query();
        
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama_unit', 'like', '%'.$this->search.'%')
                  ->orWhere('lokasi', 'like', '%'.$this->search.'%');
            });
        }
        
        $query->orderBy($this->sortField, $this->sortDirection);
        
        $departements = $query->paginate($this->perPage);
        
        // Get stats
        $totalDepartements = UnitKerja::count();
        $totalEmployees = Pegawai::count();
        
        $stats = [
            'total' => $totalDepartements,
            'employees' => $totalEmployees
        ];
        
        return view('livewire.departement.manage-departement', [
            'departements' => $departements,
            'stats' => $stats
        ]);
    }
}
