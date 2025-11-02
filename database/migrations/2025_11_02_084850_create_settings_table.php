<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('primary_color_light')->nullable();
            $table->string('secondary_color_light')->nullable();

            $table->string('primary_color_dark')->nullable();
            $table->string('secondary_color_dark')->nullable();

            $table->string('font_family_ar')->nullable();
            $table->string('font_family_en')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};