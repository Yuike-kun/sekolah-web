<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_registration',
        'full_name',
        'nisn',
        'nik',
        'competence',
        'gender',
        'place_birth',
        'birth_day',
        'religion',
        'family_status',
        'child_to',
        'sum_sibling',
        'hobby',
        'mind',
        'paud',
        'tk',
        'phone',
    ];

    // PPDB
    public function ppdb()
    {
        return $this->hasOne(PPDB::class, 'student_id', 'id')->withDefault(null);
    }
}
