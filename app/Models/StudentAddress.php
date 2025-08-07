<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;

    protected $table = 'student_address';

    protected $fillable = [
        'residence_type',
        'address',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'postal_code',
        'distance',
        'transportation',
    ];

    // RELATION REGION

    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }
}
