<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Sallary extends Component
{
    #[Layout('livewire.layouts.app-layout')]
    public function render()
    {
        return view('livewire.report.sallary');
    }
}
