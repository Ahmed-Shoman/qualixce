<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroSection extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'background_image',
        'background_image_alt',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'background_image_alt',
    ];
}
