<?php

namespace App\Livewire\Berita;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Category as ModelsCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class Category extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;

    #[Title('Kategori Berita')]
    public $namaKategori;

    public $statusKategori = true;

    public $categoryId;

    public $filters = [
        'search' => '',
    ];

    public function rules()
    {
        return [
            'namaKategori' => ['required', 'string', 'min:2', 'max:255'],
            'statusKategori' => ['boolean'],
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
            ModelsCategory::create([
                'is_active' => $this->statusKategori,
                'name' => $this->namaKategori,
            ]);
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
        $category = ModelsCategory::find($id);
        $category->is_active = $category->is_active == true ? false : true;
        $category->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status kategori berita berhasil disunting!',
        ]);
    }

    public function editCategory($id)
    {
        $category = ModelsCategory::find($id);

        if ($category) {
            $this->categoryId = $category->id;
            $this->namaKategori = $category->name;
            $this->statusKategori = $category->is_active;
        } else {
            return redirect()->back();
        }
    }

    public function updateCategory()
    {
        $this->validate();

        $category = ModelsCategory::find($this->categoryId);

        try {
            DB::beginTransaction();
            $category->update([
                'is_active' => $this->statusKategori,
                'name' => $this->namaKategori,
            ]);
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
        $category = ModelsCategory::find($id);

        $category->delete();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Kategori berhasil dihapus!',
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = ModelsCategory::query()
            ->when(! $this->sorts, fn ($query) => $query->latest())
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('is_active', 'LIKE', "%$search%");
            });

        return $this->applyPagination($query);
    }

    public function render()
    {
        return view('livewire.berita.category', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
