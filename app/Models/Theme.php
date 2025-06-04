<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'domain',

        'title',
        'description',
        'image',
        'video',
        'github_link',

        'writer',
        'release_date',
        'second_description',
        'note',
        'video_image'
    ];

    protected $casts = [
        'release_date' => 'datetime', // Automatically casts it to a Carbon instance
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function domains()
    {
        return $this->belongsToMany(Domain::class);
    }
}
