<?php
namespace App\Livewire\StudentTest;

use App\Models\AnswerTest;
use App\Models\QuestionTest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title('Tes Ujian PPDB')]

    #[Layout('layouts.blank')]

    public $step = 0;
    public $answer = [];

    public function mount() {
        if (AnswerTest::where('student_id', auth()->user()->ppdb_id)->count() >= count($this->soal)) {
            return to_route('dashboard.index');
        }
    }

    public function increaseStep()
    {
        if ($this->step < (count($this->soal) - 1)) {
            $this->step++;
        }
    }

    public function decreaseStep()
    {
        if ($this->step > 0) {
            $this->step--;
        }
    }

    public function save()
    {
        if(count($this->answer) == count($this->soal)) {
            foreach ($this->answer as $question => $answer) {
                AnswerTest::create([
                    'student_id'       => auth()->user()->ppdb_id,
                    'question_test_id' => $question,
                    'answer'           => array_values($answer)[0]['value'],
                ]);
            }
            session()->flash('alert', [
                'type'    => 'success',
                'message' => 'Selesai!',
                'detail'  => 'Anda telah menyelesaikan ujian anda!.',
            ]);
    
            return to_route('dashboard.index');
        } else {
            session()->flash('alert', [
                'type'    => 'warning',
                'message' => 'Belum Selesai!',
                'detail'  => 'Anda belum menyelesaikan ujian anda!.',
            ]);
        }
    }

    public function getSoalProperty()
    {
        return QuestionTest::with(['question_multiple_choice', 'question_essay'])->get()->toArray();
    }

    public function render()
    {
        return view('livewire.student-test.index', [
            'questions' => $this->soal,
        ]);
    }
}
