<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'video',
        'github_link',
        'writer',
        'release_date',
        'second_description',  // Add second description
        'note',                 // Add note
        'video_image',          // Add video image
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
