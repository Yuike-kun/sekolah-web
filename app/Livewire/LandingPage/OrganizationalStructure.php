<?php

namespace App\Livewire\LandingPage;

use App\Models\Profil;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class OrganizationalStructure extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Struktur Organisasi')]
    public function render()
    {
        return view('livewire.landing-page.organizational-structure', [
            'profil' => Profil::first(),
        ]);
    }
}
