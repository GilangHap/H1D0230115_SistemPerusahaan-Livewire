<?php

namespace App\Livewire\Departement;

use Livewire\Component;
use App\Models\UnitKerja;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;

class DepartementForm extends Component
{
    #[Layout('livewire.layouts.app-layout')]

    public $departmentId;
    public $nama_unit = '';
    public $lokasi = '';
    
    // Mode Edit Flag
    public $isEditMode = false;
    
    protected function rules()
    {
        return [
            'nama_unit' => [
                'required', 
                'string', 
                'max:255',
                $this->isEditMode 
                    ? Rule::unique('unit_kerjas')->ignore($this->departmentId)
                    : 'unique:unit_kerjas,nama_unit'
            ],
            'lokasi' => 'nullable|string|max:255',
        ];
    }
    
    protected $messages = [
        'nama_unit.required' => 'Nama departemen wajib diisi',
        'nama_unit.unique' => 'Nama departemen sudah digunakan',
        'nama_unit.max' => 'Nama departemen maksimal 255 karakter',
        'lokasi.max' => 'Lokasi maksimal 255 karakter',
    ];
    
    public function mount($id = null)
    {
        if ($id) {
            $this->loadDepartment($id);
            $this->isEditMode = true;
        }
    }
    
    public function loadDepartment($id)
    {
        $department = UnitKerja::findOrFail($id);
        $this->departmentId = $department->id;
        $this->nama_unit = $department->nama_unit;
        $this->lokasi = $department->lokasi;
    }
    
    public function save()
    {
        $validatedData = $this->validate();
        
        try {
            if ($this->isEditMode) {
                $department = UnitKerja::findOrFail($this->departmentId);
                $department->update($validatedData);
                
                $message = "Departemen {$this->nama_unit} berhasil diperbarui";
                $this->dispatch('departementUpdated', $message);
            } else {
                UnitKerja::create($validatedData);
                
                $message = "Departemen {$this->nama_unit} berhasil ditambahkan";
                $this->dispatch('departementAdded', $message);
            }
            
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil!',
                'text' => $message,
                'icon' => 'success',
            ]);
            
            return redirect()->route('departement.manage')->with('success', $message);
        } catch (\Exception $e) {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal!',
                'text' => "Terjadi kesalahan: {$e->getMessage()}",
                'icon' => 'error',
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.departement.departement-form');
    }
}