<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('founder_messages', function (Blueprint $table) {
            $table->id();

            // Translatable fields stored as JSON
            $table->json('message')->comment('Founder message, translatable'); // note: fixed typo from "massage" → "message"
            $table->json('name')->comment('Founder name, translatable');
            $table->json('position')->comment('Founder position, translatable');

            // Optional image for founder
            $table->string('image')->nullable()->comment('Founder image');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('founder_messages');
    }
};
