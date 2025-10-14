<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_qualixce_sections', function (Blueprint $table) {
            $table->id();

            // ✅ Translatable fields (Spatie)
            $table->json('title');
            $table->json('subtitle')->nullable();
            $table->json('image_alt')->nullable();

            // ✅ Static fields
            $table->string('image')->nullable();

            // ✅ Cards array [{ icon, title: {en, ar}, subtitle: {en, ar} }]
            $table->json('cards')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_qualixce_sections');
    }
};
