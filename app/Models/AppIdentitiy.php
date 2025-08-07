<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppIdentitiy extends Model
{
    use HasFactory;

    protected $table = 'app_identitiy';

    protected $fillable = [
        'contact_school',
        'email_school',
        'facebook_school',
        'youtube_school',
        'instagram_school',
        'twitter_school',
    ];
}
