<?php

namespace App\Livewire\Sidebar;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use function Spatie\Activitylog\activity;

class Staff extends Component
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
        // Log out the user
        Auth::logout();
        
        // Invalidate the session and regenerate the CSRF token
        session()->invalidate();
        session()->regenerateToken();
        
        // Redirect to the login page
        return redirect()->route('login');
    }
    
    public function render()
    {
        return view('livewire.sidebar.staff');
    }
}
