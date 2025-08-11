<?php
namespace App\Livewire\Program;

use App\Models\Program;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\File;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithPerPagePagination;

class Index extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithFileUploads;
    use WithPerPagePagination;
    use WithSorting;

    #[Title('Program')]
    public $filters = [
        'search' => '',
    ];

    public function changeStatus($id)
    {
        $program = Program::find($id);
        $program->is_active = $program->is_active == true ? false : true;
        $program->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status program berhasil disunting!',
        ]);
    }

    public function destroy($id)
    {
        $program = Program::find($id);

        if ($program->image) {
            File::delete(public_path('storage/'.$program->image));
        }

        $program->delete();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status program berhasil dihapus!',
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = Program::query()
            ->when(! $this->sorts, fn($query) => $query->latest())
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('information', 'LIKE', "%$search%");
            });

        return $this->applyPagination($query);
    }

    public function render()
    {
        return view('livewire.program.index', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
