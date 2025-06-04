<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowToApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'course_id',
        'student_id',
        'instruction'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
