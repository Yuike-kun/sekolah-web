<?php

namespace App\Livewire\LandingPage;

use App\Models\Profil;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class LogoMeaning extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Makna Logo')]
    public function render()
    {
        return view('livewire.landing-page.logo-meaning', [
            'profil' => Profil::first(),
        ]);
    }
}
