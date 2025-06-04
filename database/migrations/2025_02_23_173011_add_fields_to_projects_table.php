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
        Schema::table('projects', function (Blueprint $table) {
            $table->date('release_date')->nullable();
            $table->string('writer')->nullable();
            $table->text('second_description')->nullable();  // For the second description
            $table->text('note')->nullable();  // For the note
            $table->string('video_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['writer', 'second_description', 'note', 'video_image', 'release_date']);
        });
    }
};
