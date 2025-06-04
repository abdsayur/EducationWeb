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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('location')->nullable();
            $table->text('language')->nullable();
            $table->text('call_type')->nullable();
            $table->longText('details')->nullable();
            $table->string('image')->nullable();
            $table->text('university')->nullable();
            $table->text('nb_of_hours')->nullable();
            $table->date('call_date')->nullable();
            $table->text('course_timing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
