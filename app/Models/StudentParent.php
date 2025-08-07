<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory;

    protected $table = 'student_parent';

    protected $fillable = [
        'no_kk',
        'family_leader',

        'father',
        'nik_father',
        'birth_year_father',
        'status_father',
        'father_work',
        'father_income',
        'education_father',

        'mother',
        'nik_mother',
        'birth_year_mother',
        'status_mother',
        'mother_work',
        'mother_income',
        'education_mother',

        'guardian',
        'nik_guardian',
        'birth_year_guardian',
        'guardian_work',
        'guardian_income',
        'education_guardian',

        'kks',
        'pkh',
        'kip',
        'phone',
    ];
}
