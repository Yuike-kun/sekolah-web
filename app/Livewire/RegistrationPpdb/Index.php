<?php

namespace App\Livewire\RegistrationPpdb;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Informasi PPDB')]
    public $numberRegistration;

    public $nisn;

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate([
            'numberRegistration' => ['required', 'string', 'min:2', 'max:255'],
            'nisn' => ['required', 'between:5,20'],
        ]);

        if (Auth::attempt([
            'number_registration' => $this->numberRegistration, 'password' => $this->nisn,
        ])) {
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil.',
                'detail' => 'Login berhasil.',
            ]);

            return redirect()->route('dashboard.index');
        }

        session()->flash('alert', [
            'type' => 'danger',
            'message' => 'Gagal.',
            'detail' => 'Login gagal',
        ]);
    }

    public function render()
    {
        return view('livewire.registration-ppdb.index');
    }
}
