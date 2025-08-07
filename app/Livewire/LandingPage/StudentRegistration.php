<?php

namespace App\Livewire\LandingPage;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class StudentRegistration extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Pendaftaran Siswa')]
    public function render()
    {
        return view('livewire.landing-page.student-registration');
    }
}
