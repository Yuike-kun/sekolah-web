<?php

namespace App\Livewire\LandingPage;

use App\Models\Profil;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class History extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Sejarah')]
    public function render()
    {
        return view('livewire.landing-page.history', [
            'profil' => Profil::first(),
        ]);
    }
}
