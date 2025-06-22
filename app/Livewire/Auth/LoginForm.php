<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginForm extends Component
{
    public $nip;
    public $password;
    public $remember = false;

    protected $rules = [
        'nip' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['nip' => $this->nip, 'password' => $this->password], $this->remember)) {
            $pegawai = Auth::user();
            session()->regenerate();
            
            // Log successful authentication
            Log::info('Pegawai logged in successfully', [
                'id' => $pegawai->id,
                'nip' => $pegawai->nip
            ]);
            
            // Check if pegawai has a role directly
            if ($pegawai->jabatan && $pegawai->jabatan->role) {
                $role = $pegawai->jabatan->role->name;
                
                // Redirect based on role
                switch ($role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'atasan':
                        return redirect()->route('atasan.dashboard');
                    default:
                        return redirect()->route('staff.dashboard');
                }
            } else {
                // User has no role assigned
                session()->flash('warning', 'Anda belum memiliki peran yang ditetapkan. Silakan hubungi administrator.');
                return redirect()->route('staff.dashboard');
            }
        }

        // Authentication failed
        session()->flash('error', 'NIP atau password salah.');
        Log::warning('Failed login attempt', ['nip' => $this->nip]);
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
