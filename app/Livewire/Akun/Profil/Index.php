<?php

namespace App\Livewire\Akun\Profil;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    #[Title('Profil')]
    public $avatar;

    public $userName;

    public $userEmail;

    public $nomorRegistrasi;

    public $password;

    public $password_confirmation;

    public function mount()
    {
        $user = auth()->user();

        if ($user->role == 'user') {
            $this->nomorRegistrasi = $user->number_registration;
        }

        if ($user->role == 'admin') {
            $this->userEmail = $user->email;
        }

        $this->userName = $user->name;
    }

    public function validateData()
    {
        if (auth()->user()->role == 'admin') {
            $this->validate([
                'userName' => ['required', 'string', 'min:2', 'max:255'],
                'avatar' => ['nullable', 'image', 'max:2048'],
                'userEmail' => ['required', 'email'],
            ]);
        }

        if (auth()->user()->role == 'user') {
            $this->validate([
                'userName' => ['required', 'string', 'min:2', 'max:255'],
                'avatar' => ['nullable', 'image', 'max:2048'],
                'password' => ['nullable', Password::default()],
            ]);
        }

        $this->validate([
            'password' => ['nullable', 'confirmed', Password::default()],
            'password_confirmation' => ['nullable', Password::default()],
        ]);
    }

    public function save()
    {
        $this->validateData();

        $user = User::find(auth()->user()->id);

        try {
            DB::beginTransaction();
            $user->update([
                'name' => $this->userName,
            ]);

            if ($this->password) {
                $user->update(['password' => bcrypt($this->password)]);
            }

            if ($this->avatar) {
                if ($user->avatar) {
                    File::delete(public_path('storage/'.$user->avatar));
                }

                $user->update(['avatar' => $this->avatar->store('user', 'public')]);
            }

            if ($user->role == 'admin') {
                $user->update([
                    'email' => $this->userEmail,
                ]);
            } else {
                $user->udpate([
                    'number_registration' => $this->nomorRegistrasi,
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => 'Profil gagal disunting.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Profil berhasil disunting.',
        ]);

        return redirect()->route('dashboard.index');
    }

    public function render()
    {
        return view('livewire.akun.profil.index', [
            'user' => auth()->user(),
        ]);
    }
}
