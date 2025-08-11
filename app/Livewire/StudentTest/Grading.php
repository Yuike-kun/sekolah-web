<?php
namespace App\Livewire\StudentTest;

use App\Models\PPDB;
use Livewire\Component;
use App\Models\AnswerTest;
use App\Models\QuestionTest;
use App\Models\StudentGrade;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

class Grading extends Component
{
    #[Title('Menilai Ujian PPDB')]

    public $id, $siswa_data = [];
    public $essay_points = [];
    public $points = 0;

    public function mount($id)
    {
        $this->id         = $id;
        $this->siswa_data = PPDB::with(['student'])->find($id);
        $this->getAnswersProperty();
        $data_grade = StudentGrade::where('student_id', $id)->first();
        if($data_grade) {
            $this->points = $data_grade->grade;
            foreach($data_grade->detail as $q => $d) {
                if(array_key_exists('grade', $d)) {
                    $question_id = $this->answers->where('answer', $d['answer'])->first()->id;
                    $this->essay_points[$question_id] = $d['grade'];
                }
            }
        }
    }

    public function essayPoints()
    {
        $this->points = 0;
        foreach ($this->essay_points as $key => $point) {
            if (is_numeric($point)) {
                $max                      = $this->answers->where('id', $key)->first()->question->points;
                $this->essay_points[$key] = min($point, $max);
                $this->points += min($point, $max);
            }
        }
    }

    public function save()
    {
        try {
            DB::beginTransaction();

            if(StudentGrade::where('student_id', $this->id)->first()) {
                StudentGrade::where('student_id', $this->id)->delete();
            }

            $detail = [];
            foreach ($this->answers as $a) {
                if ($a->question->type == 'multiple_choice') {
                    $detail[$a->question->question] = [
                        'poin'   => $a->question->points,
                        'answer' => $a->answer_multiple_choice->option_text,
                        'status' => $a->answer_multiple_choice->is_correct,
                    ];
                } else {
                    $detail[$a->question->question] = [
                        'poin'   => $a->question->points,
                        'answer' => $a->answer,
                        'grade'  => $this->essay_points[$a->id],
                    ];
                }
            }
            StudentGrade::create([
                'student_id' => $this->id,
                'grade'      => $this->points,
                'detail'     => $detail,
            ]);

            DB::commit();

            session()->flash('alert', [
                'type'    => 'success',
                'message' => 'Selesai!',
                'detail'  => 'Berhasil menyimpan data nilai!.',
            ]);

            return to_route('tes-ujian.nilai-tes');
        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('alert', [
                'type'    => 'danger',
                'message' => 'Gagal!',
                'detail'  => 'Gagal menyimpan data nilai!.',
            ]);
        }
    }

    public function getAnswersProperty()
    {
        return AnswerTest::with(['question'])->where('student_id', $this->id)->get();
    }

    public function render()
    {
        return view('livewire.student-test.grading', [
            'answers'   => $this->answers,
            'sum_point' => QuestionTest::where('is_active', 1)->sum('points'),
        ]);
    }
}

