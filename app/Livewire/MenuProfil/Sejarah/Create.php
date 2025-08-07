<?php

namespace App\Livewire\MenuProfil\Sejarah;

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
    #[Title('Sunting Sejarah')]
    public $note;

    public $gambar;

    public function mount()
    {
        $profil = Profil::first();

        if ($profil) {
            $this->note = $profil->history;
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
                    'history' => $this->note,
                ]);
            } else {
                $profil->update([
                    'history' => $this->note,
                ]);

                if ($this->gambar && $profil->image_06) {
                    File::delete(public_path('storage/'.$profil->image_06));
                }
            }

            if ($this->gambar) {
                $profil->update(['image_06' => $this->gambar->store('/menu-profil/sejarah', 'public')]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Sejarah gagal disunting.',
            ]);

            $this->reset();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Sejarah berhasil disunting.',
        ]);

        return redirect()->route('menu-profil.sejarah.index');
    }

    public function render()
    {
        return view('livewire.menu-profil.sejarah.create');
    }
}
