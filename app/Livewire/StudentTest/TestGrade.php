<?php
namespace App\Livewire\StudentTest;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\PPDB;
use Livewire\Attributes\Title;
use Livewire\Component;

class TestGrade extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;

    #[Title('Nilai Ujian PPDB')]

    public $filters = [
        'search'               => '',
        'verification_student' => '',
        'date_start'           => '',
        'date_end'             => '',
        'nisn'                 => '',
    ];

    public function handleVerification($id)
    {
        $ppdb                          = PPDB::find($id);
        $student                       = $ppdb->student;
        $student->verification_student = $student->verification_student == 'Belum Diverifikasi' ? 'Terverifikasi' : 'Belum Diverifikasi';

        if ($student->verification_student == 'Belum Diverifikasi') {
            $student->verification_graduation = 'Proses';
        }

        $student->save();

        session()->flash('alert', [
            'type'    => 'success',
            'message' => 'Berhasil.',
            'detail'  => 'Verfikasi siswa berhasil di ubah!',
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = PPDB::query()
            ->whereHas('student', function ($query) {
                $query->when(! $this->sorts, fn($query) => $query->latest())
                    ->when($this->filters['search'], function ($query, $search) {
                        $query->where('nik', 'LIKE', "%$search%")
                            ->orWhere('nisn', 'LIKE', "%$search%")
                            ->orWhere('full_name', 'LIKE', "%$search%")
                            ->orWhere('number_registration', 'LIKE', "%$search%");
                    })
                    ->when($this->filters['nisn'], fn($query, $nisn) => $query->where('nisn', $nisn))
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
        return view('livewire.student-test.test-grade', [
            'items' => $this->getRowsQueryProperty(),
        ]);
    }
}
