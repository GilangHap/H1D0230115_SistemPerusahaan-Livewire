<?php

namespace App\Livewire\Sidebar;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Admin extends Component
{
    public $activeMenu = '';
    public $subMenu = [];
    public $activeSubMenu = '';

    public function mount($activeMenu = '', $activeSubMenu = '')
    {
        $this->activeMenu = $activeMenu;
        $this->activeSubMenu = $activeSubMenu;
        
        // Initialize submenu structure
        $this->subMenu = [
            'employees' => ['list', 'create', 'edit'],
            'master' => ['jabatan', 'unitkerja'],
            'reports' => ['absensi', 'cuti', 'payroll'],
            'absensi' => ['overview', 'checkin', 'report']
        ];
    }

    public function toggleMenu($menu)
    {
        if ($this->activeMenu === $menu) {
            $this->activeMenu = '';
        } else {
            $this->activeMenu = $menu;
        }
    }

    public function setActiveMenu($menu)
    {
        $this->activeMenu = $menu;
    }
    
    public function setActiveSubMenu($menu, $subMenu = '')
    {
        $this->activeMenu = $menu;
        $this->activeSubMenu = $subMenu;
    }

    public function render()
    {
        return view('livewire.sidebar.admin');
    }
}
