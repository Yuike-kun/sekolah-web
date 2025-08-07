<?php

namespace App\Livewire\Akun;

use App\Models\PPDB;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    #[Title('Sunting Akun')]
    public $avatar;

    public $userName;

    public $roleUser = null;

    public $pilihSiswa;

    public $nomorRegistrasiSiswa;

    public $nisnSiswa;

    public $password;

    public $userEmail;

    public $password_confirmation;

    public $ppdbId;

    public $userId;

    public function mount($id)
    {
        $user = User::whereId($id)->firstOrFail();

        $this->roleUser = $user->role;
        $this->userName = $user->name;
        $this->userId = $user->id;

        if ($user->role == 'admin') {
            $this->userEmail = $user->email;
        }

        if ($user->role == 'user') {
            $this->nomorRegistrasiSiswa = $user->number_registration;

            if ($user->ppdb_id) {
                $this->ppdbId = $user->ppdb_id;
                $this->pilihSiswa = 'Pilih Siswa';
            } else {
                $this->pilihSiswa = 'Tanpa Siswa';
            }
        }
    }

    public function validateData()
    {
        // ADMIN
        if ($this->roleUser == 'admin') {
            $this->validate([
                'userEmail' => ['required', 'email'],
                'password' => ['nullable', 'confirmed', Password::default()],
                'password_confirmation' => ['nullable', Password::default()],
            ]);
        }

        // USER / SISWA
        if ($this->roleUser == 'user') {
            $this->validate([
                'pilihSiswa' => ['required', 'string', Rule::in(config('const.verfication_account_student'))],
            ]);

            if ($this->pilihSiswa == 'Tanpa Siswa') {
                $this->validate([
                    'nisnSiswa' => ['nullable', 'between:5,20'],
                    'nomorRegistrasiSiswa' => ['required'],
                ]);
            }

            if ($this->pilihSiswa == 'Pilih Siswa') {
                $this->validate(['ppdbId' => ['required']]);
            }
        }

        $this->validate([
            'avatar' => ['nullable', 'image', 'max:2048'],
            'userName' => ['required', 'string', 'min:2', 'max:255'],
            'roleUser' => ['required', Rule::in(config('const.roles'))],
        ]);
    }

    public function edit()
    {
        $this->validateData();

        $user = User::find($this->userId);

        try {
            DB::beginTransaction();
            $user->update([
                'role' => $this->roleUser,
            ]);

            if ($this->avatar) {
                if ($user->avatar) {
                    File::delete(public_path('storage/'.$user->avatar));
                }

                $user->update(['avatar' => $this->avatar->store('user', 'public')]);
            }

            if ($this->roleUser == 'admin') {
                $user->update([
                    'email' => $this->userEmail,
                    'password' => bcrypt($this->password),
                    'name' => $this->userName,
                ]);
            }

            if ($this->roleUser == 'user') {
                if ($this->pilihSiswa == 'Tanpa Siswa') {
                    $user->update([
                        'number_registration' => $this->nomorRegistrasiSiswa,
                        'password' => bcrypt($this->nisnSiswa),
                        'name' => $this->userName,
                    ]);
                } else {
                    $ppdb = PPDB::find($this->ppdbId);

                    $student = Student::find($ppdb->student_id);

                    $user->update([
                        'number_registration' => $student->number_registration,
                        'ppdb_id' => $ppdb->id,
                        'name' => $student->full_name,
                        'password' => bcrypt($student->nisn),
                    ]);
                }
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

        return redirect()->route('setting.akun.index');
    }

    public function render()
    {
        $students = Student::all();

        return view('livewire.akun.edit', [
            'students' => isset($students) ? $students : null,
        ]);
    }
}
