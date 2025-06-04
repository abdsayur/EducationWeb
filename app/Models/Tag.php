<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }
}
