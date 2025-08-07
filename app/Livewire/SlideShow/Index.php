<?php

namespace App\Livewire\SlideShow;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\SlideShow;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithFileUploads;
    use WithPerPagePagination;
    use WithSorting;

    #[Title('Slide Show')]
    public $judulSlideShow;

    public $deskripsiSlideShow;

    public $statusSlideShow = true;

    public $gambarSlideShow;

    public $slideShowId;

    public $filters = [
        'search' => '',
    ];

    public function rules()
    {
        return [
            'judulSlideShow' => ['required', 'string', 'min:2', 'max:255'],
            'deskripsiSlideShow' => ['nullable', 'string', 'min:2', 'max:255'],
            'statusSlideShow' => ['boolean'],
            'gambarSlideShow' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            $slideShow = SlideShow::create([
                'is_active' => $this->statusSlideShow,
                'heading' => $this->judulSlideShow,
                'description' => $this->deskripsiSlideShow,
            ]);

            if ($this->gambarSlideShow) {
                $slideShow->update(['image' => $this->gambarSlideShow->store('/slide-show', 'public')]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Kategori gagal ditambah!',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Kategori berhasil ditambah!',
        ]);

        $this->reset();
        $this->resetErrorBag();
        $this->dispatch('close-modal');
    }

    public function changeStatus($id)
    {
        $slideShow = SlideShow::find($id);
        $slideShow->is_active = $slideShow->is_active == true ? false : true;
        $slideShow->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status slide show berhasil disunting!',
        ]);
    }

    public function editSlideShow($id)
    {
        $slideShow = SlideShow::find($id);

        if ($slideShow) {
            $this->slideShowId = $slideShow->id;
            $this->judulSlideShow = $slideShow->heading;
            $this->deskripsiSlideShow = $slideShow->description;
            $this->statusSlideShow = $slideShow->is_active;
        } else {
            return redirect()->back();
        }
    }

    public function updateSlideShow()
    {
        $this->validate();

        $slideShow = SlideShow::find($this->slideShowId);

        try {
            DB::beginTransaction();
            $slideShow->update([
                'is_active' => $this->statusSlideShow,
                'heading' => $this->judulSlideShow,
                'description' => $this->deskripsiSlideShow,
            ]);

            if ($this->gambarSlideShow) {
                if ($slideShow->image) {
                    File::delete(public_path('storage/'.$slideShow->image));
                }

                $slideShow->update(['image' => $this->gambarSlideShow->store('/slide-show', 'public')]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Kategori gagal disunting!',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Kategori berhasil disunting!',
        ]);

        $this->reset();
        $this->resetErrorBag();
        $this->dispatch('close-modal');
    }

    public function destroy($id)
    {
        $slideShow = SlideShow::find($id);

        if ($slideShow->image) {
            File::delete(public_path('storage/'.$slideShow->image));
        }

        $slideShow->delete();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Slide show dihapus!',
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = SlideShow::query()
            ->when(! $this->sorts, fn ($query) => $query->latest())
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('heading', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            });

        return $this->applyPagination($query);
    }

    public function render()
    {
        return view('livewire.slide-show.index', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
