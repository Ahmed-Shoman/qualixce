<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('our_values', function (Blueprint $table) {
            $table->id();
            $table->json('cards'); // Repeater as JSON
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('our_values');
    }
};
