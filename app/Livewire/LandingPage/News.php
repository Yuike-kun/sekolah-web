<?php

namespace App\Livewire\LandingPage;

use App\Models\News as Berita;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class News extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Berita')]
    public function render()
    {
        return view('livewire.landing-page.news', [
            'berita' => Berita::all()
        ]);
    }
}
