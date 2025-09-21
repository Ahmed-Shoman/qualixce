<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroSection extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'background_image',
        'background_image_alt',
    ];

    // الحقول القابلة للترجمة
    public $translatable = [
        'title',
        'subtitle',
        'background_image_alt', // ← لو عايز النص البديل يكون قابل للترجمة
    ];
}
