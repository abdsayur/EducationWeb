<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\CustomResetPassword;
use Illuminate\Auth\Notifications\ResetPassword;

class Student extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'academic_year',
        'country'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    public function howToApply()
    {
        return $this->hasOne(HowToApply::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')->withTimestamps();
    }
}
