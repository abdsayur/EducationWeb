<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banner_sections', function (Blueprint $table) {
            $table->id();

            $table->string('project_image')->nullable();
            $table->text('project_description')->nullable();
            $table->string('project_details_image')->nullable();

            $table->string('theme_image')->nullable();
            $table->text('theme_description')->nullable();
            $table->string('theme_details_image')->nullable();

            $table->string('course_image')->nullable();
            $table->text('course_description')->nullable();
            $table->string('course_details_image')->nullable();
            $table->text('course_details_description')->nullable();

            $table->string('student_service_image')->nullable();
            $table->string('student_service_title')->nullable();
            $table->text('student_service_description')->nullable();

            $table->string('professor_service_image')->nullable();
            $table->string('professor_service_title')->nullable();
            $table->text('professor_service_description')->nullable();

            $table->string('university_service_image')->nullable();
            $table->string('university_service_title')->nullable();
            $table->text('university_service_description')->nullable();

            $table->string('company_service_image')->nullable();
            $table->string('company_service_title')->nullable();
            $table->text('company_service_description')->nullable();

            $table->string('create_student_image')->nullable();
            $table->text('create_student_description')->nullable();

            $table->string('create_professor_image')->nullable();
            $table->text('create_professor_description')->nullable();

            $table->string('contact_image')->nullable();
            $table->text('contact_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_sections');
    }
};
