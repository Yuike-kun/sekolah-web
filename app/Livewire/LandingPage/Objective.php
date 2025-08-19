<?php

namespace App\Livewire\LandingPage;

use App\Models\Profil;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Objective extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Tujuan')]
    public function render()
    {
        return view('livewire.landing-page.objective', [
            'profil' => Profil::first(),
        ]);
    }
}
