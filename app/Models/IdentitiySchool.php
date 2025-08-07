<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitiySchool extends Model
{
    use HasFactory;

    protected $table = 'identitiy_school';

    protected $fillable = [
        'province',
        'regency',
        'district',
        'village',
        'name_school',
        'ladder_study',
        'vice_pricipal',
        'status_school',
        'npsn',
        'location_study',
        'logo',
        'school_level',
    ];
}
