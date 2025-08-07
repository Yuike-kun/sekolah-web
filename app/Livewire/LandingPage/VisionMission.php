<?php

namespace App\Livewire\LandingPage;

use App\Models\Profil;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class VisionMission extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Visi Misi')]
    public function render()
    {
        return view('livewire.landing-page.vision-mission', [
            'profil' => Profil::first(),
        ]);
    }
}
