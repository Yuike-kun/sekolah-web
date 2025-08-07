<?php

namespace App\Livewire\VerificationData;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\PPDB;
use Livewire\Attributes\Title;
use Livewire\Component;

class Graduation extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;

    #[Title('Verifikasi Kelulusan')]
    public $filters = [
        'search' => '',
        'verification_graduation' => '',
        'date_start' => '',
        'date_end' => '',
        'nisn' => '',
    ];

    public function verificationGraduation($id, $ket)
    {
        $ppdb = PPDB::find($id);
        $ppdb->student->verification_graduation = $ket;
        $ppdb->student->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Verfikasi kelulusan berhasil di ubah!',
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = PPDB::query()
            ->whereHas('student', function ($query) {
                $query
                    ->where('verification_student', 'Terverifikasi')
                    ->when(! $this->sorts, fn ($query) => $query->latest())
                    ->when($this->filters['search'], function ($query, $search) {
                        $query->where('nik', 'LIKE', "%$search%")
                            ->orWhere('nisn', 'LIKE', "%$search%")
                            ->orWhere('full_name', 'LIKE', "%$search%")
                            ->orWhere('number_registration', 'LIKE', "%$search%");
                    })
                    ->when($this->filters['nisn'], fn ($query, $nisn) => $query->where('nisn', $nisn))
                    ->when($this->filters['verification_graduation'], fn ($query, $status) => $query->where('verification_graduation', $status))
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
        return view('livewire.verification-data.graduation', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
