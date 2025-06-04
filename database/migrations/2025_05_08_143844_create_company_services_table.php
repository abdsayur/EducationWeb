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
        Schema::create('company_services', function (Blueprint $table) {
            $table->id();

            $table->text('desc_d')->nullable();

            $table->string('title_td')->nullable();
            $table->text('desc_td')->nullable();

            $table->string('title_tdi_1')->nullable();
            $table->text('desc_tdi_1')->nullable();
            $table->string('image_tdi_1')->nullable();
            $table->string('title_tdi_2')->nullable();
            $table->text('desc_tdi_2')->nullable();
            $table->string('image_tdi_2')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_services');
    }
};
