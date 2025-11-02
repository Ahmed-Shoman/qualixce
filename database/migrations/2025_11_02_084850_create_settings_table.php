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
            $table->string('key')->unique(); // مفتاح الإعداد مثلاً 'hero_color'
            $table->text('value')->nullable(); // القيمة (لون - خط - أي حاجة)
            $table->string('type')->nullable(); // نوع الإعداد (color, font, text, image)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};