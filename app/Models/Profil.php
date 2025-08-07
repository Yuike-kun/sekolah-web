<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active_ppdb',
        'history',
        'image_06',
        'origin_name',
        'logo_meaning',
        'image_01',
        'title_foreword',
        'foreword',
        'image_04',
        'vision_mission',
        'image_05',
        'objective',
        'image_02',
        'image_03',
        'structure_organization',
    ];
}
