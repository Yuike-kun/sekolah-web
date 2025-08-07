<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Layout('layouts.guest')]
    #[Title('Login')]
    public $email = '';

    public $password = '';

    public bool $success = false;

    public function save()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_active' => true])) {
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil.',
                'detail' => 'Login berhasil.',
            ]);

            return to_route('dashboard.index');
        }

        session()->flash('alert', [
            'type' => 'danger',
            'message' => 'Gagal.',
            'detail' => 'Login gagal',
        ]);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
