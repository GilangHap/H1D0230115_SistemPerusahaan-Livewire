<?php

namespace App\Livewire\Member;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

class AllMember extends Component
{
    use WithPagination;
    use WithFileUploads;
    
#[Layout('livewire.layouts.app-layout')]

    // Search & Filter
    public $search = '';
    public $filterDepartment = '';
    public $filterPosition = '';
    public $sortField = 'nama';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
    // View Modes
    public $viewMode = 'grid';
    public $showFilters = false;
    
    // Employee Details Modal
    public $selectedEmployee = null;
    public $isViewingDetails = false;
    public $selectedTab = 'profile';
    
    // Delete Confirmation
    public $employeeToDelete = null;
    public $isConfirmingDelete = false;

    // Bulk Actions
    public $selectAll = false;
    public $selectedEmployees = [];
    public $bulkAction = '';

    // Define listeners for events
    protected $listeners = [
        'refreshEmployees' => '$refresh',
        'deleteEmployee' => 'deleteEmployee'
    ];

    public function mount()
    {
        $this->resetPage();
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function updatedFilterDepartment()
    {
        $this->resetPage();
    }
    
    public function updatedFilterPosition()
    {
        $this->resetPage();
    }
    
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedEmployees = $this->getEmployeesQuery()->pluck('id')->map(function($id) {
                return (string) $id;
            })->toArray();
        } else {
            $this->selectedEmployees = [];
        }
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
    
    // Employee Detail Modal
    public function viewDetails($employeeId)
    {
        $this->selectedEmployee = Pegawai::with(['jabatan', 'unitKerja'])->find($employeeId);
        $this->selectedTab = 'profile';
        $this->isViewingDetails = true;
    }
    
    public function closeDetails()
    {
        $this->isViewingDetails = false;
        $this->selectedEmployee = null;
    }
    
    public function changeTab($tab)
    {
        $this->selectedTab = $tab;
    }
    
    // Delete Modal and Actions
    public function confirmDelete($employeeId)
    {
        $this->employeeToDelete = $employeeId;
        $this->isConfirmingDelete = true;
    }
    
    public function cancelDelete()
    {
        $this->employeeToDelete = null;
        $this->isConfirmingDelete = false;
    }
    
    public function deleteEmployee($data = null)
    {
        // If data is passed from the header modal
        if ($data && isset($data['employeeId'])) {
            $this->employeeToDelete = $data['employeeId'];
        }
        
        try {
            $employee = Pegawai::find($this->employeeToDelete);
            
            if ($employee) {
                // Remove profile photo if exists
                if ($employee->foto_profil && Storage::exists('public/profile-photos/' . $employee->foto_profil)) {
                    Storage::delete('public/profile-photos/' . $employee->foto_profil);
                }
                
                $employee->delete();
                
                $this->dispatch('showAlert', [
                    'type' => 'success', 
                    'message' => "Pegawai {$employee->nama} berhasil dihapus"
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('showAlert', [
                'type' => 'error', 
                'message' => "Gagal menghapus pegawai: " . $e->getMessage()
            ]);
        }
        
        $this->employeeToDelete = null;
        $this->isConfirmingDelete = false;
        $this->isViewingDetails = false;
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }
    
    public function resetFilters()
    {
        $this->search = '';
        $this->filterDepartment = '';
        $this->filterPosition = '';
        $this->resetPage();
    }
    
    public function executeAction($action, $employeeId)
    {
        switch ($action) {
            case 'view':
                $this->viewDetails($employeeId);
                break;
            case 'edit':
                return redirect()->route('admin.employee.edit', ['id' => $employeeId]);
                break;
            case 'delete':
                $this->confirmDelete($employeeId);
                break;
        }
    }
    
    public function executeBulkAction()
    {
        if (empty($this->selectedEmployees) || empty($this->bulkAction)) {
            return;
        }
        
        switch ($this->bulkAction) {
            case 'delete':
                // For safety, we'll just show a message instead of actually implementing bulk delete
                $this->dispatch('showAlert', [
                    'type' => 'error', 
                    'message' => "Bulk delete tidak diimplementasikan untuk alasan keamanan"
                ]);
                break;
        }
        
        $this->selectedEmployees = [];
        $this->selectAll = false;
        $this->bulkAction = '';
    }
    
    private function getEmployeesQuery()
    {
        $query = Pegawai::query()
            ->with(['jabatan', 'unitKerja']);
            
        // Apply search
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%'.$this->search.'%')
                  ->orWhere('nip', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }
        
        // Apply filters
        if (!empty($this->filterDepartment)) {
            $query->where('unit_kerja_id', $this->filterDepartment);
        }
        
        if (!empty($this->filterPosition)) {
            $query->where('jabatan_id', $this->filterPosition);
        }
        
        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);
        
        return $query;
    }
    
    public function render()
    {
        $employees = $this->getEmployeesQuery()->paginate($this->perPage);
        
        $departments = UnitKerja::orderBy('nama_unit', 'asc')->get();
        $positions = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        
        // Get some statistics
        $totalEmployees = Pegawai::count();
        
        $stats = [
            'total' => $totalEmployees,
            'departments' => UnitKerja::count(),
            'positions' => Jabatan::count(),
        ];

        return view('livewire.member.all-member', [
            'employees' => $employees,
            'departments' => $departments,
            'positions' => $positions,
            'stats' => $stats
        ]);
    }
}