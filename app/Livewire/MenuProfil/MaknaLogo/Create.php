<?php

namespace App\Livewire\MenuProfil\MaknaLogo;

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
    #[Title('Sunting Makna Logo')]
    public $note;

    public $gambar;

    public function mount()
    {
        $profil = Profil::first();

        if ($profil) {
            $this->note = $profil->logo_meaning;
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
                    'logo_meaning' => $this->note,
                ]);
            } else {
                $profil->update([
                    'logo_meaning' => $this->note,
                ]);

                if ($this->gambar && $profil->image_01) {
                    File::delete(public_path('storage/'.$profil->image_01));
                }
            }

            if ($this->gambar) {
                $profil->update(['image_01' => $this->gambar->store('/menu-profil/makna-logo', 'public')]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Makna logo gagal disunting.',
            ]);

            $this->reset();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Makna logo berhasil disunting.',
        ]);

        return redirect()->route('menu-profil.makna-logo.index');
    }

    public function render()
    {
        return view('livewire.menu-profil.makna-logo.create');
    }
}
