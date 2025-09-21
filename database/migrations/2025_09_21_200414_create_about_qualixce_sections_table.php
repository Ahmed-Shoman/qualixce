<?php
// Migration: create_about_qualixce_sections_table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_qualixce_sections', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('subtitle')->nullable();
            $table->json('cards')->nullable(); // array of {icon, title, subtitle} per card
            $table->string('image')->nullable();
            $table->json('image_alt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_qualixce_sections');
    }
};