<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function question_multiple_choice() {
        return $this->hasMany(QuestionMultipleChoice::class, 'question_test_id', 'id');
    }

    public function question_essay() {
        return $this->hasOne(QuestionEssay::class, 'question_test_id', 'id');
    }
}
