<?php

namespace App\Livewire;

use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Departement extends Component
{
    use WithPagination;
    
    #[Layout('livewire.layouts.app-layout')]
    public $search = '';
    public $sortField = 'nama_unit';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
    // Form properties
    public $unitKerjaId;
    public $nama_unit;
    public $lokasi;
    public $isEditing = false;
    public $showModal = false;
    
    protected $rules = [
        'nama_unit' => 'required|min:3|max:50',
        'lokasi' => 'required|min:3|max:100',
    ];
    
    public function render()
    {
        $user = Auth::user();
        $query = UnitKerja::query();
        
        // Filter based on user role
        if ($user->hasRole('manager')) {
            // Managers can only see their own department
            $userDepartment = $user->unitKerja->id ?? null;
            if ($userDepartment) {
                $query->where('id', $userDepartment);
            } else {
                // If manager doesn't have a department, show nothing
                $query->where('id', 0);
            }
        }
        
        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama_unit', 'like', '%' . $this->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $this->search . '%');
            });
        }
        
        // Apply sorting
        $unitKerjas = $query->orderBy($this->sortField, $this->sortDirection)
                          ->paginate($this->perPage);
        
        // Get staff count for each department
        foreach ($unitKerjas as $unit) {
            $unit->staff_count = Pegawai::where('unit_kerja_id', $unit->id)->count();
        }
        
        return view('livewire.departement', [
            'unitKerjas' => $unitKerjas,
            'isAdmin' => $user->hasRole('admin')
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
    
    public function openModal($id = null)
    {
        // Check permissions
        if (!Auth::user()->hasRole('admin')) {
            $this->dispatch('swal:modal', [
                'title' => 'Tidak Diizinkan!',
                'text' => 'Anda tidak memiliki izin untuk mengedit data departemen.',
                'icon' => 'error',
            ]);
            return;
        }
        
        $this->resetValidation();
        $this->resetFormFields();
        
        if ($id) {
            $unitKerja = UnitKerja::findOrFail($id);
            $this->unitKerjaId = $unitKerja->id;
            $this->nama_unit = $unitKerja->nama_unit;
            $this->lokasi = $unitKerja->lokasi;
            $this->isEditing = true;
        } else {
            $this->isEditing = false;
        }
        
        $this->showModal = true;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
    }
    
    public function resetFormFields()
    {
        $this->unitKerjaId = null;
        $this->nama_unit = '';
        $this->lokasi = '';
    }
    
    public function save()
    {
        // Check permissions
        if (!Auth::user()->hasRole('admin')) {
            $this->dispatch('swal:modal', [
                'title' => 'Tidak Diizinkan!',
                'text' => 'Anda tidak memiliki izin untuk menyimpan data departemen.',
                'icon' => 'error',
            ]);
            return;
        }
        
        $this->validate();
        
        if ($this->isEditing) {
            $unitKerja = UnitKerja::findOrFail($this->unitKerjaId);
            $unitKerja->update([
                'nama_unit' => $this->nama_unit,
                'lokasi' => $this->lokasi,
            ]);
            
            $message = 'Departemen berhasil diperbarui.';
        } else {
            UnitKerja::create([
                'nama_unit' => $this->nama_unit,
                'lokasi' => $this->lokasi,
            ]);
            
            $message = 'Departemen baru berhasil ditambahkan.';
        }
        
        $this->closeModal();
        $this->resetFormFields();
        
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => $message,
            'icon' => 'success',
        ]);
    }
    
    public function confirmDelete($id)
    {
        // Check permissions
        if (!Auth::user()->hasRole('admin')) {
            $this->dispatch('swal:modal', [
                'title' => 'Tidak Diizinkan!',
                'text' => 'Anda tidak memiliki izin untuk menghapus departemen.',
                'icon' => 'error',
            ]);
            return;
        }
        
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data departemen akan dihapus permanen!',
            'icon' => 'warning',
            'confirmText' => 'Ya, hapus!',
            'cancelText' => 'Batal',
            'method' => 'deleteUnitKerja',
            'params' => $id,
        ]);
    }

    public function viewMembers($departmentId)
    {
        return redirect()->route('departement.members', ['id' => $departmentId]);
    }
    
    public function deleteUnitKerja($id)
    {
        // Check permissions
        if (!Auth::user()->hasRole('admin')) {
            $this->dispatch('swal:modal', [
                'title' => 'Tidak Diizinkan!',
                'text' => 'Anda tidak memiliki izin untuk menghapus departemen.',
                'icon' => 'error',
            ]);
            return;
        }
        
        try {
            // Check if any staff are assigned to this department
            $staffCount = Pegawai::where('unit_kerja_id', $id)->count();
            
            if ($staffCount > 0) {
                $this->dispatch('swal:modal', [
                    'title' => 'Tidak Dapat Dihapus!',
                    'text' => 'Masih terdapat ' . $staffCount . ' pegawai yang terdaftar di departemen ini.',
                    'icon' => 'error',
                ]);
                return;
            }
            
            UnitKerja::findOrFail($id)->delete();
            
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil!',
                'text' => 'Departemen berhasil dihapus.',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal:modal', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
