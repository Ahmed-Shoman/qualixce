<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('excellence_areas', function (Blueprint $table) {
            $table->id();

            // Translatable fields
            $table->json('title');       // Spatie translatable
            $table->json('subtitle');    // Spatie translatable

            // Cards per locale
            // Example: { "en": [...], "ar": [...] }
            $table->json('cards')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('excellence_areas');
    }
};
