<?php

namespace App\Livewire;

use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;


    #[Layout('livewire.layouts.app-layout')]
    // User data
    public $pegawai;
    
    // Form properties
    public $nama;
    public $email;
    public $no_telp;
    public $alamat;
    public $new_password;
    public $current_password;
    public $password_confirmation;
    public $foto_profil;
    public $new_foto_profil;
    
    // UI states
    public $isEditing = false;
    public $activeTab = 'info';
    public $isChangingPassword = false;
    
    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'no_telp' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:500',
        'new_foto_profil' => 'nullable|image|max:1024', // 1MB max
    ];

    protected $validationAttributes = [
        'nama' => 'nama lengkap',
        'no_telp' => 'nomor telepon',
        'new_foto_profil' => 'foto profil',
    ];
    
    public function mount()
    {
        $this->loadUserData();
    }
    
    public function loadUserData()
    {
        $this->pegawai = Pegawai::with(['jabatan', 'unitKerja'])->find(Auth::id());
        
        if ($this->pegawai) {
            $this->nama = $this->pegawai->nama;
            $this->email = $this->pegawai->email;
            $this->no_telp = $this->pegawai->no_telp;
            $this->alamat = $this->pegawai->alamat;
            $this->foto_profil = $this->pegawai->foto_profil;
        }
    }
    
    public function startEditing()
    {
        $this->isEditing = true;
    }
    
    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->new_foto_profil = null;
        $this->loadUserData(); // Reset form data
        $this->resetValidation();
    }
    
    public function changeTab($tab)
    {
        $this->activeTab = $tab;
        // If switching to a different tab while editing, cancel editing
        if ($this->isEditing) {
            $this->cancelEdit();
        }
    }
    
    public function startChangingPassword()
    {
        $this->isChangingPassword = true;
    }
    
    public function cancelChangingPassword()
    {
        $this->isChangingPassword = false;
        $this->current_password = null;
        $this->new_password = null;
        $this->password_confirmation = null;
        $this->resetValidation();
    }
    
    public function updateProfile()
    {
        // Custom validation rules that need to check current user
        $this->rules['email'] = [
            'required',
            'email',
            'max:255',
            Rule::unique('pegawais')->ignore($this->pegawai->id),
        ];
        
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => $this->rules['email'],
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'new_foto_profil' => 'nullable|image|max:1024', // 1MB max
        ]);
        
        // Profile picture handling
        if ($this->new_foto_profil) {
            // Delete old image if it exists and isn't the default
            if ($this->pegawai->foto_profil && $this->pegawai->foto_profil !== 'default-avatar.png') {
                Storage::disk('public')->delete('profile-photos/' . $this->pegawai->foto_profil);
            }
            
            // Store new image
            $filename = 'profile-' . $this->pegawai->id . '-' . time() . '.' . $this->new_foto_profil->getClientOriginalExtension();
            $this->new_foto_profil->storeAs('profile-photos', $filename, 'public');
            $this->pegawai->foto_profil = $filename;
            $this->foto_profil = $filename; // Update local property
        }
        
        // Update user data
        $this->pegawai->nama = $this->nama;
        $this->pegawai->email = $this->email;
        $this->pegawai->no_telp = $this->no_telp;
        $this->pegawai->alamat = $this->alamat;
        $this->pegawai->save();
        
        $this->isEditing = false;
        $this->new_foto_profil = null;
        
        // Add a flash message for success
        session()->flash('message', 'Profil berhasil diperbarui.');
        session()->flash('message-type', 'success');
        
        // Also dispatch an event for SweetAlert if you're using it
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => 'Profil berhasil diperbarui.',
            'icon' => 'success',
        ]);
    }
    
    public function updatePassword()
    {
        // Validate password fields with better rules
        $validated = $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'password_confirmation' => 'required|same:new_password',
        ]);
        
        // Check if current password is correct
        if (!Hash::check($this->current_password, $this->pegawai->password)) {
            $this->addError('current_password', 'Password saat ini tidak sesuai.');
            return;
        }
        
        try {
            // Update password
            $this->pegawai->password = Hash::make($this->new_password);
            $this->pegawai->save();
            
            // Reset form after success
            $this->current_password = null;
            $this->new_password = null;
            $this->password_confirmation = null;
            $this->isChangingPassword = false;
            
            // Add a flash message for success
            session()->flash('message', 'Password berhasil diperbarui.');
            session()->flash('message-type', 'success');
            
            // Also dispatch an event for SweetAlert if you're using it
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil!',
                'text' => 'Password berhasil diperbarui.',
                'icon' => 'success',
            ]);
            
        } catch (\Exception $e) {
            // Show error message
            $this->dispatch('swal:modal', [
                'title' => 'Gagal!',
                'text' => 'Terjadi kesalahan saat memperbarui password. ' . $e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.profile');
    }
}
