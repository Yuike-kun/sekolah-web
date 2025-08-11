<?php

namespace App\Livewire\LandingPage;

use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class NewsSingle extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Berita')]

    public $id;

    public function mount($id) {
        $this->id = $id;
    }

    public function getBeritaProperty() {
        return News::find($this->id);
    }

    public function render()
    {
        return view('livewire.landing-page.news-single', [
            'berita' => $this->berita,
            'other' => News::whereNot('id', $this->id)->get()
        ]);
    }
}
