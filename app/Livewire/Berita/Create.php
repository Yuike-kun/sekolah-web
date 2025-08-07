<?php

namespace App\Livewire\Berita;

use App\Models\Category;
use App\Models\News;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Title('Tambah Berita')]
    public $kategoriBerita;

    public $statusBerita = true;

    public $gambarBerita;

    public $judulBerita;

    public $note;

    public function save()
    {
        $this->validate([
            'note' => ['required', 'string'],
            'statusBerita' => ['boolean'],
            'kategoriBerita' => ['required'],
            'gambarBerita' => ['required', 'image', 'max:2048'],
            'judulBerita' => ['required', 'string', 'min:2', 'max:255'],
        ]);

        try {
            DB::beginTransaction();

            $news = News::create([
                'heading' => $this->judulBerita,
                'body' => $this->note,
                'category_id' => $this->kategoriBerita,
                'is_active' => $this->statusBerita,
            ]);

            if ($this->gambarBerita) {
                $news->update(['image' => $this->gambarBerita->store('/menu-berita/berita', 'public')]);
            }

            if ($news) {
                $news->update([
                    'slug' => Str::slug($this->judulBerita.$news->id),
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => 'Berita gagal ditambah',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Berita berhasil ditambah',
        ]);

        return redirect()->route('menu-berita.index');
    }

    public function render()
    {
        return view('livewire.berita.create', [
            'categories' => Category::all(),
        ]);
    }
}
