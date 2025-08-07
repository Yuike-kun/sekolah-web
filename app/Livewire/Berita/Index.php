<?php

namespace App\Livewire\Berita;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;

    #[Title('Berita')]
    public $filters = [
        'search' => '',
    ];

    public function changeStatus($id)
    {
        $berita = News::find($id);
        $berita->is_active = $berita->is_active == true ? false : true;
        $berita->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status berita berhasil disunting!',
        ]);
    }

    public function destroy($id)
    {
        $news = News::find($id);

        if ($news->image) {
            File::delete(public_path('storage/'.$news->image));
        }

        $news->delete();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status berita berhasil dihapus!',
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = News::query()
            ->when(! $this->sorts, fn ($query) => $query->latest())
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('heading', 'LIKE', "%$search%")
                    ->orWhere('body', 'LIKE', "%$search%")
                    ->orWhereHas('kategori', function ($query) {
                        $query->when($this->filters['search'], function ($query, $search) {
                            $query->where('name', 'LIKE', "%$search%");
                        });
                    });
            });

        return $this->applyPagination($query);
    }

    public function render()
    {
        return view('livewire.berita.index', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
