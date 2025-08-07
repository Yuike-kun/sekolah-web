<?php

namespace App\Livewire\KataSambutan;

use App\Models\Profil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.app')]
    #[Title('Kata Sambutan')]
    public function destroy()
    {
        $profil = Profil::first();

        try {
            DB::beginTransaction();
            if ($profil) {
                if ($profil->image_04) {
                    File::delete(public_path('storage/'.$profil->image_04));
                }

                $profil->update(['foreword' => null, 'title_foreword' => null, 'image_04' => null]);
            }
            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Kata sambutan gagal dikosongkan.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Kata sambutan berhasil dikosongkan.',
        ]);
    }

    public function render()
    {
        return view('livewire.kata-sambutan.index', [
            'profil' => Profil::first(),
        ]);
    }
}
