<?php
namespace App\Livewire\Master\Tests;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\QuestionEssay;
use App\Models\QuestionMultipleChoice;
use App\Models\QuestionTest;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;

    public $filters = [
        'search' => ''
    ];

    #[Title('Daftar Soal Ujian Tes')]

    public function setStatus($id)
    {
        $data = QuestionTest::findOrFail($id);
        if ($data->is_active == 1) {
            $data->update([
                'is_active' => 0,
            ]);
        } else {
            $data->update([
                'is_active' => 1,
            ]);
        }
    }

    public function destroy($id)
    {
        $data = QuestionTest::with(['question_multiple_choice', 'question_essay'])->findOrFail($id);

        try {
            DB::beginTransaction();
            if ($data) {
                if ($data->question_multiple_choice) {
                    QuestionMultipleChoice::where('question_test_id', $id)->delete();
                } elseif ($data->question_essay) {
                    QuestionEssay::where('question_test_id', $id)->delete();
                }
                $data->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type'    => 'danger',
                'message' => 'Gagal!',
                'detail'  => 'Soal gagal dihapus.',
            ]);
        }

        session()->flash('alert', [
            'type'    => 'success',
            'message' => 'Berhasil!',
            'detail'  => 'Soal berhasil dihapus.',
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = QuestionTest::query()
            ->when($this->filters['search'], function ($query, $value) {
                return $query->where('question', 'LIKE', '%' . $value . '%');
            });
        // ->whereHas('student', function ($query) {
        //     $query->when(! $this->sorts, fn ($query) => $query->latest())
        //         ->when($this->filters['search'], function ($query, $search) {
        //             $query->where('nik', 'LIKE', "%$search%")
        //                 ->orWhere('nisn', 'LIKE', "%$search%")
        //                 ->orWhere('full_name', 'LIKE', "%$search%")
        //                 ->orWhere('number_registration', 'LIKE', "%$search%");
        //         })
        //         ->when($this->filters['nisn'], fn ($query, $nisn) => $query->where('nisn', $nisn))
        //         ->when($this->filters['gender'], fn ($query, $gender) => $query->where('gender', $gender))
        //         ->when($this->filters['date_start'], fn ($query, $date) => $query->where('created_at', '>=', $date))
        //         ->when($this->filters['date_end'], fn ($query, $date) => $query->where('created_at', '<=', $date));
        // });

        return $this->applyPagination($query);
    }

    public function render()
    {
        return view('livewire.master.tests.index', [
            'rows' => $this->rows_query,
        ]);
    }
}
