<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proven_processes', function (Blueprint $table) {
            $table->id();
            $table->json('title');       // translatable
            $table->json('subtitle');    // translatable
            $table->json('cards');       // array of {icon, title, subtitle}, translatable
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proven_processes');
    }
};