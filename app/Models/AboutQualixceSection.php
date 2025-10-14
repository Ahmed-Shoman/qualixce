<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutQualixceSection extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'cards',
        'image',
        'image_alt',
    ];

    /**
     * Translatable fields using Spatie
     */
    public $translatable = [
        'title',
        'subtitle',
        'image_alt',
        
    ];

    /**
     * Casts for proper handling of JSON fields
     */
    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'image_alt' => 'array',
        'cards' => 'array', // Holds multiple cards with multilingual data
    ];
}
