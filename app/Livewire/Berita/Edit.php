<?php

namespace App\Livewire\Berita;

use App\Models\Category;
use App\Models\News;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    #[Title('Sunting Berita')]
    public $note;

    public $kategoriBerita;

    public $statusBerita = true;

    public $gambarBerita;

    public $judulBerita;

    public $newsId;

    public function mount($id)
    {
        $news = News::where('id', $id)->firstOrFail();

        $this->newsId = $news->id;
        $this->note = $news->body;
        $this->kategoriBerita = $news->category_id;
        $this->statusBerita = $news->is_active;
        $this->judulBerita = $news->heading;
    }

    public function edit()
    {
        $news = News::find($this->newsId);

        $this->validate([
            'note' => ['required', 'string'],
            'statusBerita' => ['boolean'],
            'kategoriBerita' => ['required'],
            'gambarBerita' => ['nullable', 'image', 'max:2048'],
            'judulBerita' => ['required', 'string', 'min:2', 'max:255'],
        ]);

        try {
            DB::beginTransaction();

            $news->update([
                'heading' => $this->judulBerita,
                'body' => $this->note,
                'category_id' => $this->kategoriBerita,
                'is_active' => $this->statusBerita,
            ]);

            if ($this->gambarBerita) {
                if ($news->image) {
                    File::delete(public_path('storage/'.$news->image));
                }

                $news->update(['image' => $this->gambarBerita->store('/menu-berita/berita/', 'public')]);
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
                'detail' => 'Berita gagal disunting',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Berita berhasil disunting',
        ]);

        return redirect()->route('menu-berita.index');
    }

    public function render()
    {
        return view('livewire.berita.edit', [
            'categories' => Category::all(),
        ]);
    }
}
