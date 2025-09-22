<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('founder_messages', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // translatable
            $table->json('description'); // translatable
            $table->json('name'); // translatable
            $table->json('position'); // translatable
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('founder_messages');
    }
};