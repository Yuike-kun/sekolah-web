<?php

namespace App\Livewire\Akun;

use App\Models\PPDB;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Title('Tambah Akun')]
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

    public function mount()
    {
        $this->nomorRegistrasiSiswa = number_registration();
    }

    public function validateData()
    {
        // ADMIN
        if ($this->roleUser == 'admin') {
            $this->validate([
                'userEmail' => ['required', 'email'],
                'password' => ['required', 'confirmed', Password::default()],
                'password_confirmation' => ['required', Password::default()],
            ]);
        }

        // USER / SISWA
        if ($this->roleUser == 'user') {
            $this->validate([
                'pilihSiswa' => ['required', 'string', Rule::in(config('const.verfication_account_student'))],
            ]);

            if ($this->pilihSiswa == 'Tanpa Siswa') {
                $this->validate([
                    'nisnSiswa' => ['required', 'between:5,20'],
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

    public function save()
    {
        $this->validateData();

        try {
            DB::beginTransaction();
            $user = User::create([
                'role' => $this->roleUser,
            ]);

            if ($this->avatar) {
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
                'detail' => 'Profil gagal ditambah.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Profil berhasil ditambah.',
        ]);

        return redirect()->route('setting.akun.index');
    }

    public function render()
    {
        $students = Student::all();

        return view('livewire.akun.create', [
            'students' => isset($students) ? $students : null,
        ]);
    }
}
