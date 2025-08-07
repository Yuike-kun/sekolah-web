<?php

namespace App\Livewire\KataSambutan;

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
    #[Title('Sunting Sambutan')]
    public $nama;

    public $sambutan;

    public $gambar;

    public function mount()
    {
        $profil = Profil::first();

        if ($profil) {
            $this->nama = $profil->title_foreword;
            $this->sambutan = $profil->foreword;
        }
    }

    public function save()
    {
        $this->validate([
            'nama' => ['required', 'string', 'min:2', 'max:255'],
            'sambutan' => ['required', 'string', 'min:2'],
            'gambar' => ['nullable', 'image', 'max:2048'],
        ]);

        $profil = Profil::first();

        try {
            DB::beginTransaction();
            if (! isset($profil)) {
                $profil = Profil::create([
                    'title_foreword' => $this->nama,
                    'foreword' => $this->sambutan,
                ]);
            } else {
                $profil->update([
                    'title_foreword' => $this->nama,
                    'foreword' => $this->sambutan,
                ]);

                if ($this->gambar && $profil->image_04) {
                    File::delete(public_path('storage/'.$profil->image_04));
                }
            }

            if ($this->gambar) {
                $profil->update(['image_04' => $this->gambar->store('/sambutan', 'public')]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Kata sambutan gagal disunting.',
            ]);

            $this->reset();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Kata sambutan berhasil disunting.',
        ]);

        return redirect()->route('kata-sambutan.index');
    }

    public function render()
    {
        return view('livewire.kata-sambutan.create');
    }
}
