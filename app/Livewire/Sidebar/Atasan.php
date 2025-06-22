<?php

namespace App\Livewire\Sidebar;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Atasan extends Component
{
    public $activeMenu = 'dashboard';
    
    public function setActiveMenu($menu)
    {
        $this->activeMenu = $menu;
    }
    
    public function toggleMenu($menu)
    {
        $this->activeMenu = $this->activeMenu === $menu ? '' : $menu;
    }
    
    public function setActiveSubMenu($menu, $submenu)
    {
        $this->activeMenu = $menu;
        // You can track active submenu as well if needed
    }
    
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect()->route('login');
    }
    
    public function render()
    {
        return view('livewire.sidebar.atasan');
    }
}
