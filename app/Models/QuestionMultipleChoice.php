<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionMultipleChoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_correct' => 'boolean'
    ];

    public function question_tests() {
        return $this->belongsTo(QuestionTest::class, 'question_tests_id', 'id');
    }
}
