<?php
namespace App\Livewire\Master\Tests;

use App\Models\QuestionEssay;
use App\Models\QuestionMultipleChoice;
use App\Models\QuestionTest;
use Livewire\Attributes\Title;
use Livewire\Component;

class Create extends Component
{
    public $question,
    $points,
    $count_option = 0,
    $type         = '',
    $options      = [];

    #[Title('Tambah Soal Ujian')]

    public function updatedType()
    {
        $this->reset('count_option', 'options');
    }

    // public function setAsCorrectOption($int_question) {
    //     foreach($this->options as $key => $val) {
    //         if(($this->options[$key]['correct'] ?? false) == true) {
    //             $this->options[$key]['correct'] == false;
    //         }
    //     }
    //     $this->options[$int_question]['correct'] = true;
    // }

    public function save()
    {
        $validate = $this->validate([
            'question'     => 'required',
            'points'       => 'required|max:100|numeric',
            'count_option' => 'required_if:type,multiple_choice|max:3|numeric',
            'type'         => 'required',
            'options'      => 'required_if:type,multiple_choice',
        ]);

        try {
            $question_test = QuestionTest::create([
                'question'  => $validate['question'],
                'type'      => $validate['type'],
                'points'    => $validate['points'],
                'is_active' => true,
            ]);

            if ($validate['type'] == 'multiple_choice') {
                foreach ($validate['options'] as $opt) {
                    QuestionMultipleChoice::create([
                        'question_test_id' => $question_test->id,
                        'option_text'      => $opt['label'],
                        'is_correct'       => $opt['correct'] ?? false,
                    ]);
                }
            } else {
                QuestionEssay::create([
                    'question_test_id' => $question_test->id,
                ]);
            }

            session()->flash('alert', [
                'type'    => 'success',
                'message' => 'Berhasil!',
                'detail'  => 'Soal berhasil disunting.',
            ]);

            return redirect()->route('master.ujian.index');
        } catch (\Exception $e) {
            dd($e);
            session()->flash('alert', [
                'type'    => 'danger',
                'message' => 'Gagal!',
                'detail'  => 'Soal gagal disunting.',
            ]);

            $this->reset();
        }
    }

    public function render()
    {
        return view('livewire.master.tests.create');
    }
}
