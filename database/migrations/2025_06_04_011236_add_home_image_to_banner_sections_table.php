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
        Schema::table('banner_sections', function (Blueprint $table) {
            $table->string('home_image');
            $table->string('home_text_1')->nullable();
            $table->string('home_text_2')->nullable();
            $table->string('home_text_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banner_sections', function (Blueprint $table) {
            $table->dropColumn('home_image');
            $table->dropColumn('home_text_1');
            $table->dropColumn('home_text_2');
            $table->dropColumn('home_text_3');
        });
    }
};
