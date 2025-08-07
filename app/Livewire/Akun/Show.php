<?php

namespace App\Livewire\Akun;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class Show extends Component
{
    #[Title('Detail Akun')]
    public $user;

    public $ppdb;

    public $student;

    public function mount($id)
    {
        $this->user = User::whereId($id)->firstOrFail();

        if ($this->user->role == 'user') {
            $this->ppdb = $this->user->ppdb;
            $this->student = $this->ppdb->student;
        }
    }

    public function render()
    {
        return view('livewire.akun.show');
    }
}
