<?php

namespace App\Livewire\Position;

use App\Models\Role;
use App\Models\Jabatan;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;

class PositionForm extends Component
{
    #[Layout('livewire.layouts.app-layout')]
    public $positionId;
    public $nama_jabatan = '';
    public $tunjangan = 0;
    public $role_id = '';
    
    // Mode Edit Flag
    public $isEditMode = false;
    
    protected function rules()
    {
        return [
            'nama_jabatan' => [
                'required', 
                'string', 
                'max:255',
                $this->isEditMode 
                    ? Rule::unique('jabatans')->ignore($this->positionId)
                    : 'unique:jabatans,nama_jabatan'
            ],
            'tunjangan' => 'required|numeric|min:0',
            'role_id' => 'required|exists:roles,id',
        ];
    }
    
    protected $messages = [
        'nama_jabatan.required' => 'Nama jabatan wajib diisi',
        'nama_jabatan.unique' => 'Nama jabatan sudah digunakan',
        'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter',
        'tunjangan.required' => 'Tunjangan wajib diisi',
        'tunjangan.numeric' => 'Tunjangan harus berupa angka',
        'tunjangan.min' => 'Tunjangan tidak boleh negatif',
        'role_id.required' => 'Role wajib dipilih',
        'role_id.exists' => 'Role yang dipilih tidak valid',
    ];
    
    public function mount($id = null)
    {
        if ($id) {
            $this->loadPosition($id);
            $this->isEditMode = true;
        }
    }
    
    public function loadPosition($id)
    {
        $position = Jabatan::findOrFail($id);
        $this->positionId = $position->id;
        $this->nama_jabatan = $position->nama_jabatan;
        $this->tunjangan = $position->tunjangan;
        $this->role_id = $position->role_id;
    }
    
    public function save()
    {
        $validatedData = $this->validate();
        
        try {
            if ($this->isEditMode) {
                $position = Jabatan::findOrFail($this->positionId);
                $position->update($validatedData);
                
                $message = "Jabatan {$this->nama_jabatan} berhasil diperbarui";
                $this->dispatch('positionUpdated', $message);
            } else {
                Jabatan::create($validatedData);
                
                $message = "Jabatan {$this->nama_jabatan} berhasil ditambahkan";
                $this->dispatch('positionAdded', $message);
            }
            
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil!',
                'text' => $message,
                'icon' => 'success',
            ]);
            
            return redirect()->route('position.manage')->with('success', $message);
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
        $roles = Role::orderBy('name')->get();
        
        return view('livewire.position.position-form', [
            'roles' => $roles
        ]);
    }
}