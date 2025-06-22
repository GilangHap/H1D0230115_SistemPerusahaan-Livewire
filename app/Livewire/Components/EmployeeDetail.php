<?php
namespace App\Livewire\Components;

use App\Models\Pegawai;
use Livewire\Component;

class EmployeeDetail extends Component
{
    public $employee = null;
    public $selectedTab = 'profile';
    
    // Update the listener to match the event name from the modal
    protected $listeners = ['open-employee-detail' => 'viewEmployeeDetails'];

    // Fix the parameter handling
    public function viewEmployeeDetails($employeeId)
    {
        // Just directly use the employeeId - no need for array access
        if ($employeeId) {
            $this->employee = Pegawai::with(['jabatan', 'unitKerja'])->find($employeeId);
            $this->selectedTab = 'profile';
        }
    }
    
    public function changeTab($tab)
    {
        $this->selectedTab = $tab;
    }
    
    public function render()
    {
        return view('livewire.components.employee-detail');
    }
}