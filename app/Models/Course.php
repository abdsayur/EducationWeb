<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'language',
        'call_type',
        'details',
        'university',
        'nb_of_hours',
        'call_date',
        'course_timing',
        'image',

        'objective',
        'material',
        'requirement',
    ];

    protected $casts = [
        'call_date' => 'datetime', // Automatically casts it to a Carbon instance
    ];

    public function howToApply()
    {
        return $this->hasOne(HowToApply::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student')->withTimestamps();
    }
}
