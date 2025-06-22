<?php

namespace App\Livewire\Member;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\UnitKerja;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeForm extends Component
{
    use WithFileUploads;

    #[Layout('livewire.layouts.app-layout')]
    // Form Fields
    public $employeeId;
    public $nip;
    public $nama;
    public $email;
    public $password;
    public $password_confirmation;
    public $jabatan_id;
    public $unit_kerja_id;
    public $gaji_pokok;
    public $no_telp;
    public $alamat;
    public $foto_profil;
    public $temp_foto_profil;

    // Edit Mode Flag
    public $isEditMode = false;
    
    // Step Form
    public $currentStep = 1;
    public $totalSteps = 3;
    
    // For Preview
    public $previewMode = false;
    public $selectedEmployee;
    public $unitKerjaNama;
    public $jabatanNama;

    protected function rules()
    {
        return [
            'nip' => ['required', 'string', 'max:20', 
                $this->isEditMode 
                    ? Rule::unique('pegawais')->ignore($this->employeeId)
                    : 'unique:pegawais'],
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', 
                $this->isEditMode 
                    ? Rule::unique('pegawais')->ignore($this->employeeId)
                    : 'unique:pegawais'],
            'password' => $this->isEditMode ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
            'jabatan_id' => 'required|exists:jabatans,id',
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'gaji_pokok' => 'required|numeric|min:0',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'foto_profil' => $this->isEditMode ? 'nullable|image|max:1024' : 'nullable|image|max:1024',
        ];
    }

    protected $messages = [
        'nip.required' => 'NIP wajib diisi',
        'nip.unique' => 'NIP sudah digunakan',
        'nama.required' => 'Nama lengkap wajib diisi',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah digunakan',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
        'jabatan_id.required' => 'Jabatan wajib dipilih',
        'unit_kerja_id.required' => 'Unit kerja wajib dipilih',
        'gaji_pokok.required' => 'Gaji pokok wajib diisi',
        'gaji_pokok.numeric' => 'Gaji pokok harus berupa angka',
        'foto_profil.image' => 'File harus berupa gambar',
        'foto_profil.max' => 'Ukuran gambar maksimal 1MB',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->loadEmployee($id);
            $this->isEditMode = true;
        } else {
            $this->generateNIP();
        }
    }

    public function loadEmployee($id)
    {
        $employee = Pegawai::findOrFail($id);
        $this->employeeId = $employee->id;
        $this->nip = $employee->nip;
        $this->nama = $employee->nama;
        $this->email = $employee->email;
        $this->jabatan_id = $employee->jabatan_id;
        $this->jabatanNama = $employee->jabatan ? $employee->jabatan->nama_jabatan : null;
        $this->unit_kerja_id = $employee->unit_kerja_id;
        $this->unitKerjaNama = $employee->unitKerja ? $employee->unitKerja->nama_unit : null;
        $this->gaji_pokok = $employee->gaji_pokok;
        $this->no_telp = $employee->no_telp;
        $this->alamat = $employee->alamat;
        $this->temp_foto_profil = $employee->foto_profil;
    }

    public function generateNIP()
    {
        // Generate a unique employee ID (NIP)
        $prefix = date('Ym');
        $lastEmployee = Pegawai::where('nip', 'like', $prefix . '%')
            ->orderBy('nip', 'desc')
            ->first();
        
        if ($lastEmployee) {
            $lastNumber = (int) substr($lastEmployee->nip, 6);
            $newNumber = $lastNumber + 1;
            $this->nip = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        } else {
            $this->nip = $prefix . '0001';
        }
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validateOnly('nip');
            $this->validateOnly('nama');
            $this->validateOnly('email');
            
            if (!$this->isEditMode || $this->password) {
                $this->validateOnly('password');
                $this->validateOnly('password_confirmation');
            }
        } elseif ($this->currentStep === 2) {
            $this->validateOnly('jabatan_id');
            $this->validateOnly('unit_kerja_id');
            $this->validateOnly('gaji_pokok');
        }
        
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function togglePreview()
    {
        $this->previewMode = !$this->previewMode;
        
        if ($this->previewMode) {
            // For preview, get the department and position names
            if ($this->unit_kerja_id) {
                $unit = UnitKerja::find($this->unit_kerja_id);
                $this->unitKerjaNama = $unit ? $unit->nama_unit : null;
            }
            
            if ($this->jabatan_id) {
                $jabatan = Jabatan::find($this->jabatan_id);
                $this->jabatanNama = $jabatan ? $jabatan->nama_jabatan : null;
            }
        }
    }

    public function save()
    {
        $validatedData = $this->validate();

        try {
            if ($this->isEditMode) {
                $employee = Pegawai::findOrFail($this->employeeId);
                
                // Only hash the password if it was actually provided
                if ($this->password) {
                    $validatedData['password'] = Hash::make($this->password);
                } else {
                    unset($validatedData['password']);
                }
                
                // Handle profile photo upload - mengikuti pattern di Profile.php
                if ($this->foto_profil) {
                    // Delete old image if it exists and isn't the default
                    if ($employee->foto_profil && $employee->foto_profil !== 'default-avatar.png' && 
                        Storage::disk('public')->exists('profile-photos/' . $employee->foto_profil)) {
                        Storage::disk('public')->delete('profile-photos/' . $employee->foto_profil);
                    }
                    
                    // Store new image dengan format nama yang sama seperti di Profile.php
                    $filename = 'profile-' . $employee->id . '-' . time() . '.' . $this->foto_profil->getClientOriginalExtension();
                    $this->foto_profil->storeAs('profile-photos', $filename, 'public');
                    $validatedData['foto_profil'] = $filename;
                } else {
                    // Keep existing photo
                    unset($validatedData['foto_profil']);
                }
                
                $employee->update($validatedData);
                
                $message = "Data pegawai {$employee->nama} berhasil diperbarui";
            } else {
                // Always hash the password for new employees
                $validatedData['password'] = Hash::make($this->password);
                
                // Create employee first to get the ID
                unset($validatedData['foto_profil']); // Remove photo from initial creation
                $employee = Pegawai::create($validatedData);
                
                // Handle profile photo upload - mengikuti pattern di Profile.php
                if ($this->foto_profil) {
                    // Store new image dengan format nama yang sama seperti di Profile.php
                    $filename = 'profile-' . $employee->id . '-' . time() . '.' . $this->foto_profil->getClientOriginalExtension();
                    $this->foto_profil->storeAs('profile-photos', $filename, 'public');
                    
                    // Update the employee with the photo
                    $employee->foto_profil = $filename;
                    $employee->save();
                }
                
                $message = "Pegawai baru {$employee->nama} berhasil ditambahkan";
            }
            
            session()->flash('message', $message);
            session()->flash('type', 'success');
            
            // Tambahkan juga dispatch event untuk SweetAlert seperti di Profile.php
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil!', 
                'text' => $message,
                'icon' => 'success',
            ]);
            
            return redirect()->route('member');
        } catch (\Exception $e) {
            session()->flash('message', 'Error: ' . $e->getMessage());
            session()->flash('type', 'error');
            
            // Tambahkan juga dispatch event untuk SweetAlert error
            $this->dispatch('swal:modal', [
                'title' => 'Gagal!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    public function render()
    {
        $departments = UnitKerja::orderBy('nama_unit', 'asc')->get();
        $positions = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        
        return view('livewire.member.employee-form', [
            'departments' => $departments,
            'positions' => $positions
        ]);
    }
}
