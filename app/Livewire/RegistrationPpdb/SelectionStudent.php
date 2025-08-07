<?php

namespace App\Livewire\RegistrationPpdb;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class SelectionStudent extends Component
{
    #[Title('Hasil Seleksi')]
    #[Layout('layouts.landing-page')]
    public function render()
    {
        return view('livewire.registration-ppdb.selection-student');
    }
}
