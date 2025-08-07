<?php

namespace App\Livewire\LandingPage;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Program extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Program')]
    public function render()
    {
        return view('livewire.landing-page.program');
    }
}
