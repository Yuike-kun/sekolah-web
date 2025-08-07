<?php

namespace App\Livewire\MenuProfil\StrukturOrganisasi;

use App\Models\Profil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.app')]
    #[Title('Sejarah')]
    public function destroy()
    {
        $profil = Profil::first();
        try {
            DB::beginTransaction();
            if ($profil) {
                if ($profil->image_03) {
                    File::delete(public_path('storage/'.$profil->image_03));
                }

                $profil->update(['structure_organization' => null, 'image_03' => null]);
            }
            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Struktur Organisasi gagal dikosongkan.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Struktur Organisasi berhasil dikosongkan.',
        ]);
    }

    public function render()
    {
        return view('livewire.menu-profil.struktur-organisasi.index', [
            'profil' => Profil::first(),
        ]);
    }
}
