<?php

namespace App\Livewire\MenuProfil\Tujuan;

use App\Models\Profil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Layout('layouts.app')]
    #[Title('Sunting Tujuan')]
    public $note;

    public $gambar;

    public function mount()
    {
        $profil = Profil::first();

        if ($profil) {
            $this->note = $profil->objective;
        }

    }

    public function save()
    {
        $this->validate([
            'note' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (strip_tags($value) === '') {
                        $this->note = null;
                    }
                },
            ],
            'gambar' => ['nullable', 'image'],
        ]);

        $profil = Profil::first();

        try {
            DB::beginTransaction();
            if (! isset($profil)) {
                $profil = Profil::create([
                    'objective' => $this->note,
                ]);
            } else {
                $profil->update([
                    'objective' => $this->note,
                ]);

                if ($this->gambar && $profil->image_02) {
                    File::delete(public_path('storage/'.$profil->image_02));
                }
            }

            if ($this->gambar) {
                $profil->update(['image_02' => $this->gambar->store('/menu-profil/tujuan', 'public')]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Tujuan gagal disunting.',
            ]);

            $this->reset();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Tujuan berhasil disunting.',
        ]);

        return redirect()->route('menu-profil.tujuan.index');
    }

    public function render()
    {
        return view('livewire.menu-profil.tujuan.create');
    }
}
