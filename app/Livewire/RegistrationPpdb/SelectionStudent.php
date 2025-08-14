<?php
namespace App\Livewire\RegistrationPpdb;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\PPDB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class SelectionStudent extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;

    public $filters = [
        'search'                  => '',
        'verification_graduation' => '',
        'date_start'              => '',
        'date_end'                => '',
        'nisn'                    => '',
    ];

    #[Title('Hasil Seleksi')]
    #[Layout('layouts.landing-page')]

    public function getRowsQueryProperty()
    {
        $query = PPDB::query()
            ->whereHas('student', function ($query) {
                $query
                    ->where('verification_student', 'Terverifikasi')
                    ->when(! $this->sorts, fn($query) => $query->latest())
                    ->when($this->filters['search'], function ($query, $search) {
                        $query->where('nik', 'LIKE', "%$search%")
                            ->orWhere('nisn', 'LIKE', "%$search%")
                            ->orWhere('full_name', 'LIKE', "%$search%")
                            ->orWhere('number_registration', 'LIKE', "%$search%");
                    })
                    ->when($this->filters['nisn'], fn($query, $nisn) => $query->where('nisn', $nisn))
                    ->when($this->filters['verification_graduation'], fn($query, $status) => $query->where('verification_graduation', $status))
                    ->when($this->filters['date_start'], fn($query, $date) => $query->where('created_at', '>=', $date))
                    ->when($this->filters['date_end'], fn($query, $date) => $query->where('created_at', '<=', $date));
            });

        return $this->applyPagination($query);
    }

    public function resetFilter()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.registration-ppdb.selection-student', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
