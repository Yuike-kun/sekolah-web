<?php

namespace App\Livewire\MenuProfil\VisiMisi;

use App\Models\Profil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.app')]

    #[Title('Visi Misi')]
    public function destroy()
    {
        $profil = Profil::first();
        try {
            DB::beginTransaction();
            if ($profil) {
                if ($profil->image_05) {
                    File::delete(public_path('storage/'.$profil->image_05));
                }

                $profil->update(['vision_mission' => null, 'image_01' => null]);
            }
            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Visi Misi gagal dikosongkan.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Visi Misi berhasil dikosongkan.',
        ]);
    }

    public function render()
    {
        return view('livewire.menu-profil.visi-misi.index', [
            'profil' => Profil::first(),
        ]);
    }
}
