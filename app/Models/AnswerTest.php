<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerTest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getAnswerMultipleChoiceAttribute() {
        return QuestionMultipleChoice::find($this->answer);
    }

    public function question() {
        return $this->hasOne(QuestionTest::class, 'id', 'question_test_id');
    }
}
