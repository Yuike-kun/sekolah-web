<?php

namespace App\Livewire\LandingPage;

use App\Models\Profil;
use App\Models\SlideShow;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Beranda')]
    public function render()
    {
        return view('livewire.landing-page.index', [
            'profil' => Profil::first(),
            'slides' => SlideShow::all(),
        ]);
    }
}
