<?php

namespace App\Livewire;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberDepartement extends Component
{
    use WithPagination;

    #[Layout('livewire.layouts.app-layout')]
    
    public $departmentId;
    public $departmentName;
    public $search = '';
    public $sortField = 'nama';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $filterJabatan = '';
    
    // For detail modal
    public $showDetailModal = false;
    public $selectedStaff = null;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'filterJabatan' => ['except' => ''],
        'sortField' => ['except' => 'nama'],
        'sortDirection' => ['except' => 'asc'],
    ];

    // Remove the type hint for $id which causes the dependency injection error
    public function mount($id = null)
    {
        // Check if $id is null and try to get it from the route parameters
        if ($id === null) {
            $id = request()->route('id');
        }
        
        // Now handle the case where we still don't have an ID
        if (!$id) {
            return redirect()->route('departement');
        }
        
        $user = Auth::user();
        $unitKerja = UnitKerja::find($id);
        
        if (!$unitKerja) {
            return redirect()->route('departement');
        }
        
        // Check permissions - only allow if admin or manager of this department
        if (!$user->hasRole('admin') && 
            ($user->hasRole('manager') && $user->unit_kerja_id != $id)) {
            
            return redirect()->route('departement')->with('error', 'Anda tidak memiliki akses ke departemen ini.');
        }
        
        $this->departmentId = $id;
        $this->departmentName = $unitKerja->nama_unit;
    }

    public function render()
    {
        $query = Pegawai::where('unit_kerja_id', $this->departmentId);
        
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('nip', 'like', '%' . $this->search . '%')
                  ->orWhere('no_telepon', 'like', '%' . $this->search . '%');
            });
        }
        
        if (!empty($this->filterJabatan)) {
            $query->where('jabatan_id', $this->filterJabatan);
        }
        
        $staffMembers = $query->orderBy($this->sortField, $this->sortDirection)
                            ->with('jabatan')
                            ->paginate($this->perPage);
        
        $jabatanList = Jabatan::orderBy('nama_jabatan')->get();
        
        return view('livewire.member-departement', [
            'staffMembers' => $staffMembers,
            'jabatanList' => $jabatanList
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
        $this->reset(['search', 'filterJabatan', 'sortField', 'sortDirection']);
        $this->resetPage();
    }
    
    public function showStaffDetail($id)
    {
        $this->selectedStaff = Pegawai::with(['jabatan', 'unitKerja'])->find($id);
        $this->showDetailModal = true;
    }
    
    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedStaff = null;
    }
    
    public function getProfilePhotoUrl($photoFilename)
    {
        if (!$photoFilename) {
            return asset('images/default-avatar.svg');
        }
        
        return Storage::url('profile-photos/' . $photoFilename);
    }
    
    // Navigation method to go back to department list
    public function backToDepartmentList()
    {
        return redirect()->route('departement');
    }
}
