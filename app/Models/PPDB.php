<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPDB extends Model
{
    use HasFactory;

    protected $table = 'ppdb';

    protected $fillable = [
        'is_verification',
        'number_registration',
        'student_id',
        'student_address_id',
        'student_parent_id',
        'identitiy_school_id',
    ];

    // TABLE STUDENT
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id')->withDefault();
    }

    // TABLE STUDENT ADDRESS
    public function studentAddress()
    {
        return $this->belongsTo(StudentAddress::class, 'student_address_id', 'id')->withDefault();
    }

    // TABLE STUDENT PARENT
    public function studentParent()
    {
        return $this->belongsTo(StudentParent::class, 'student_parent_id', 'id')->withDefault();
    }

    // TABLE IDENTITIY SCHOOL
    public function identitiySchool()
    {
        return $this->belongsTo(IdentitiySchool::class, 'identitiy_school_id', 'id')->withDefault();
    }

    // USER
    public function akun()
    {
        return $this->hasOne(User::class, 'ppdb_id', 'id')->withDefault(null);
    }

    //ujian
    public function result_tests() {
        return $this->hasMany(AnswerTest::class, 'id', 'student_id')->withDefault(null);
    }

    //Nilai Pilgan
    public function getGradeTestAttribute() {
        $nilai = 0;
        $data = AnswerTest::with(['question.question_multiple_choice', 'question.question_essay'])->where('student_id', $this->id)->get();
        foreach($data as $d) {
            if($d->question->type == 'multiple_choice') {
                if((int) $d->answer == $d->question->question_multiple_choice->where('is_correct', 1)->first()->id) {
                    $nilai += $d->points;
                }
            }
        }
        return $nilai;
    }
}
