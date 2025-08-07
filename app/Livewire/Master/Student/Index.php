<?php

namespace App\Livewire\Master\Student;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\PPDB;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;

    #[Title('Verifikasi Siswa')]
    public $filters = [
        'search' => '',
        'date_start' => '',
        'date_end' => '',
        'nisn' => '',
        'gender' => '',
    ];

    public function getRowsQueryProperty()
    {
        $query = PPDB::query()
            ->whereHas('student', function ($query) {
                $query->when(! $this->sorts, fn ($query) => $query->latest())
                    ->when($this->filters['search'], function ($query, $search) {
                        $query->where('nik', 'LIKE', "%$search%")
                            ->orWhere('nisn', 'LIKE', "%$search%")
                            ->orWhere('full_name', 'LIKE', "%$search%")
                            ->orWhere('number_registration', 'LIKE', "%$search%");
                    })
                    ->when($this->filters['nisn'], fn ($query, $nisn) => $query->where('nisn', $nisn))
                    ->when($this->filters['gender'], fn ($query, $gender) => $query->where('gender', $gender))
                    ->when($this->filters['date_start'], fn ($query, $date) => $query->where('created_at', '>=', $date))
                    ->when($this->filters['date_end'], fn ($query, $date) => $query->where('created_at', '<=', $date));
            });

        return $this->applyPagination($query);
    }

    public function resetFilter()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.master.student.index', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
