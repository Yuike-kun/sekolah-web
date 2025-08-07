<?php

namespace App\Livewire\Akun;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;

    #[Title('Akun')]
    public $filters = [
        'search' => '',
    ];

    public function changeStatus($id)
    {
        $user = User::find($id);

        if ($user->id == auth()->user()->id) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => 'Anda tidak dapat mengubah status akun jika sendang di gunakan!',
            ]);

            return redirect()->back();
        }

        $user->is_active = $user->is_active == true ? false : true;
        $user->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status akun berhasil disunting!',
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->id == auth()->user()->id) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => 'Anda tidak dapat menghapus akun jika sendang di gunakan!',
            ]);

            return redirect()->back();
        }

        if ($user->avatar) {
            File::delete(public_path('storage/'.$user->avatar));
        }

        $user->delete();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status berita berhasil dihapus!',
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = User::query()
            ->when(! $this->sorts, fn ($query) => $query->latest())
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('role', 'LIKE', "%$search%")
                    ->orWhere('number_registration', 'LIKE', "%$search%");
            });

        return $this->applyPagination($query);
    }

    public function render()
    {
        return view('livewire.akun.index', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
