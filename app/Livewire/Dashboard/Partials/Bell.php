<?php

namespace App\Livewire\Dashboard\Partials;

use App\Models\Student;
use Livewire\Component;

class Bell extends Component
{
    public $notVerification;

    public function mount()
    {
        $this->notVerification = Student::query()
            ->where('verification_student', 'Belum Diverifikasi')
            ->whereYear('created_at', '>=', date('Y'))
            ->groupBy('verification_student')
            ->count();
    }

    public function render()
    {
        return view('livewire.dashboard.partials.bell', [
            'verification' => $this->notVerification,
        ]);
    }
}
