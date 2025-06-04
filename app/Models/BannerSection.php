<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_image',
        'home_text_1',
        'home_text_2',
        'home_text_3',

        'project_image',
        'project_description',
        'project_details_image',

        'theme_image',
        'theme_description',
        'theme_details_image',

        'course_image',
        'course_description',
        'course_details_image',
        'course_details_description',

        'student_service_image',
        'student_service_title',
        'student_service_description',

        'professor_service_image',
        'professor_service_title',
        'professor_service_description',

        'university_service_image',
        'university_service_title',
        'university_service_description',

        'company_service_image',
        'company_service_title',
        'company_service_description',

        'create_student_image',
        'create_student_description',

        'create_professor_image',
        'create_professor_description',

        'contact_image',
        'contact_description',
    ];
}
