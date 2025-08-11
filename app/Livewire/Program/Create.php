<?php
namespace App\Livewire\Program;

use Exception;
use App\Models\Program;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use WithFileUploads;

    public $namaProgram, $informasiProgram, $gambarProgram, $statusProgram = true;

    #[Title('Tambah Program')]

    public function save()
    {
        $this->validate([
            'namaProgram'      => ['required', 'string', 'min:2', 'max:255'],
            'statusProgram'    => ['boolean'],
            'informasiProgram' => ['required'],
            'gambarProgram'    => ['required', 'image', 'max:2048'],
        ]);

        try {
            DB::beginTransaction();

            $program = Program::create([
                'name'        => $this->namaProgram,
                'Information' => $this->informasiProgram,
                'is_active'   => $this->statusProgram,
            ]);

            if ($this->gambarProgram) {
                $program->update(['image' => $this->gambarProgram->store('/menu-program/program', 'public')]);
            }

            DB::commit();
        } catch (Exception $e) {
            dd($e);
            session()->flash('alert', [
                'type'    => 'danger',
                'message' => 'Gagal.',
                'detail'  => 'Program gagal ditambah',
            ]);
        }

        session()->flash('alert', [
            'type'    => 'success',
            'message' => 'Berhasil.',
            'detail'  => 'Program berhasil ditambah',
        ]);

        return redirect()->route('program.index');
    }

    public function render()
    {
        return view('livewire.program.create');
    }
}
