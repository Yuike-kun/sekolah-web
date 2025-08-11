<?php

namespace App\Livewire\LandingPage;

use App\Models\News;
use App\Models\Profil;
use Livewire\Component;
use App\Models\SlideShow;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Index extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Beranda')]
    public function render()
    {
        return view('livewire.landing-page.index', [
            'profil' => Profil::first(),
            'slides' => SlideShow::all(),
            'berita' => News::limit(3)->get()
        ]);
    }
}
