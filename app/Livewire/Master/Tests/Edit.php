<?php
namespace App\Livewire\Master\Tests;

use App\Models\QuestionEssay;
use App\Models\QuestionMultipleChoice;
use App\Models\QuestionTest;
use Livewire\Attributes\Title;
use Livewire\Component;

class Edit extends Component
{
    public $question,
    $points,
    $count_option = 0,
    $type         = '',
    $options      = [];
    public $idData;

    #[Title('Edit Soal Ujian')]

    public function mount($id)
    {
        $this->idData = $id;
        $data         = QuestionTest::with(['question_multiple_choice', 'question_essay'])->findOrFail($id);
        if ($data) {
            $this->question = $data->question;
            $this->type     = $data->type;
            $this->points   = $data->points;
        }
        if ($data->type == 'multiple_choice') {
            $i = 0;
            foreach ($data->question_multiple_choice as $value) {
                $this->count_option = count($data->question_multiple_choice);
                $this->options[$i] = [
                    'label' => $value->option_text,
                    'correct' => $value->is_correct
                ];
                $i++;
            }
        }
    }

    public function updatedType()
    {
        $this->reset('count_option', 'options');
    }

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
            $question_test = QuestionTest::where('id', $this->idData)->update([
                'question'  => $validate['question'],
                'type'      => $validate['type'],
                'points'    => $validate['points'],
                'is_active' => true,
            ]);

            if ($validate['type'] == 'multiple_choice') {
                if (QuestionMultipleChoice::where('question_test_id', $this->idData)->get()) {
                    QuestionMultipleChoice::where('question_test_id', $this->idData)->delete();
                }
                foreach ($validate['options'] as $opt) {
                    QuestionMultipleChoice::create([
                        'question_test_id' => $this->idData,
                        'option_text'      => $opt['label'],
                        'is_correct'       => $opt['correct'] ?? false,
                    ]);
                }
                QuestionEssay::where('question_test_id', $this->idData)->delete();
            } else {
                if (QuestionMultipleChoice::where('question_test_id', $this->idData)->get()) {
                    QuestionEssay::where('question_test_id', $this->idData)->update([
                        'question_test_id' => $this->idData,
                    ]);
                } else {
                    QuestionEssay::create([
                        'question_test_id' => $this->idData,
                    ]);
                }
                QuestionMultipleChoice::where('question_test_id', $this->idData)->delete();
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
        return view('livewire.master.tests.edit');
    }
}
