<?php

namespace App\Livewire\MenuProfil\Sejarah;

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
                if ($profil->image_06) {
                    File::delete(public_path('storage/'.$profil->image_06));
                }

                $profil->update(['history' => null, 'image_06' => null]);
            }
            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Sejarah gagal dikosongkan.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Sejarah berhasil dikosongkan.',
        ]);
    }

    public function render()
    {
        return view('livewire.menu-profil.sejarah.index', [
            'profil' => Profil::first(),
        ]);
    }
}
