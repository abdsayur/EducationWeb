<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'whatsapp',
        'email',
        'facebook',
        'linkedin',
        'instagram',
        'location',
        'latitude',
        'longitude',
        'youtube',
        'title',
        'description'
    ];
}
