<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AppLayout extends Component
{
    public $title = 'Dashboard';
    public $pegawai;
    public $slot;
    
    public function mount($slot = '')
    {
        $this->pegawai = Auth::user();
        $this->slot = $slot;
    }

    public function render()
    {
        return view('livewire.layouts.app-layout');
    }
}
