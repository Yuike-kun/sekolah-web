<?php
namespace App\Livewire\Program;

use App\Models\Program;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use WithFileUploads;

    public $id;
    public $namaProgram, $informasiProgram, $gambarProgram, $statusProgram = true;

    #[Title('Edit Program')]

    public function mount($id)
    {
        $data = Program::where('id', $id)->firstOrFail();

        $this->id               = $data->id;
        $this->namaProgram      = $data->name;
        $this->informasiProgram = $data->Information;
        $this->statusProgram    = $data->is_active;
    }

    public function save()
    {
        $data = Program::where('id', $this->id)->firstOrFail();

        $this->validate([
            'namaProgram'      => ['required', 'string', 'min:2', 'max:255'],
            'statusProgram'    => ['boolean'],
            'informasiProgram' => ['required'],
            'gambarProgram'    => ['sometimes', 'nullable', 'image', 'max:2048'],
        ]);

        try {
            DB::beginTransaction();

            $program = $data->update([
                'name'        => $this->namaProgram,
                'Information' => $this->informasiProgram,
                'is_active'   => $this->statusProgram,
            ]);
            
            if ($this->gambarProgram) {
                if ($data->image) {
                    File::delete(public_path('storage/' . $data->image));
                }

                $program->update(['image' => $this->gambarProgram->store('/menu-program/program', 'public')]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type'    => 'danger',
                'message' => 'Gagal.',
                'detail'  => 'Program gagal disunting',
            ]);
        }

        session()->flash('alert', [
            'type'    => 'success',
            'message' => 'Berhasil.',
            'detail'  => 'Program berhasil disunting',
        ]);

        return redirect()->route('program.index');
    }

    public function render()
    {
        return view('livewire.program.edit');
    }
}
