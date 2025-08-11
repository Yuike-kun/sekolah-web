<?php

namespace App\Livewire\LandingPage;

use App\Models\Program as Data;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Program extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Program')]
    public function render()
    {
        return view('livewire.landing-page.program', [
            'programs' => Data::all()
        ]);
    }
}
