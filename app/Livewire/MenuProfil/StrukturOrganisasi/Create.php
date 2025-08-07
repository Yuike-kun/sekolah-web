<?php

namespace App\Livewire\MenuProfil\StrukturOrganisasi;

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
    #[Title('Sunting Struktur Organisasi')]
    public $note;

    public $gambar;

    public function mount()
    {
        $profil = Profil::first();

        if ($profil) {
            $this->note = $profil->structure_organization;
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
                    'structure_organization' => $this->note,
                ]);
            } else {
                $profil->update([
                    'structure_organization' => $this->note,
                ]);

                if ($this->gambar && $profil->image_03) {
                    File::delete(public_path('storage/'.$profil->image_03));
                }
            }

            if ($this->gambar) {
                $profil->update(['image_03' => $this->gambar->store('/menu-profil/struktur-organisasi', 'public')]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Struktur Organisasi gagal disunting.',
            ]);

            $this->reset();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Struktur Organisasi berhasil disunting.',
        ]);

        return redirect()->route('menu-profil.struktur-organisasi.index');
    }

    public function render()
    {
        return view('livewire.menu-profil.struktur-organisasi.create');
    }
}
