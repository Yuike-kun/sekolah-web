<?php

namespace App\Livewire\MenuProfil\VisiMisi;

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
    #[Title('Sunting Visi Misi')]
    public $note;

    public $gambar;

    public function mount()
    {
        $profil = Profil::first();

        if ($profil) {
            $this->note = $profil->vision_mission;
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
                    'vision_mission' => $this->note,
                ]);
            } else {
                $profil->update([
                    'vision_mission' => $this->note,
                ]);

                if ($this->gambar && $profil->image_05) {
                    File::delete(public_path('storage/'.$profil->image_05));
                }
            }

            if ($this->gambar) {
                $profil->update(['image_05' => $this->gambar->store('/menu-profil/visi-misi', 'public')]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Visi Misi gagal disunting.',
            ]);

            $this->reset();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Visi Misi berhasil disunting.',
        ]);

        return redirect()->route('menu-profil.visi-misi.index');
    }

    public function render()
    {
        return view('livewire.menu-profil.visi-misi.create');
    }
}
