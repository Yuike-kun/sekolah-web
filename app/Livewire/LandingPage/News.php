<?php

namespace App\Livewire\LandingPage;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class News extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Berita')]
    public function render()
    {
        return view('livewire.landing-page.news');
    }
}
