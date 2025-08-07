<?php

namespace App\Livewire\MenuProfil\MaknaLogo;

use App\Models\Profil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.app')]
    #[Title('Makna Logo')]
    public function destroy()
    {
        $profil = Profil::first();
        try {
            DB::beginTransaction();
            if ($profil) {
                if ($profil->image_01) {
                    File::delete(public_path('storage/'.$profil->image_01));
                }

                $profil->update(['logo_meaning' => null, 'image_01' => null]);
            }
            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Makna logo gagal dikosongkan.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Makna logo berhasil dikosongkan.',
        ]);
    }

    public function render()
    {
        return view('livewire.menu-profil.makna-logo.index', [
            'profil' => Profil::first(),
        ]);
    }
}
