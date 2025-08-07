<?php

namespace App\Livewire\MenuProfil\Tujuan;

use App\Models\Profil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    #[Layout('layouts.app')]

    #[Title('Tujuan')]
    public function destroy()
    {
        $profil = Profil::first();
        try {
            DB::beginTransaction();
            if ($profil) {
                if ($profil->image_02) {
                    File::delete(public_path('storage/'.$profil->image_02));
                }

                $profil->update(['objective' => null, 'image_02' => null]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Tujuan gagal dikosongkan.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Tujuan berhasil dikosongkan.',
        ]);
    }

    public function render()
    {
        return view('livewire.menu-profil.tujuan.index', [
            'profil' => Profil::first(),
        ]);
    }
}
