<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Partner extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'images',
        'is_active'
    ];

    public $translatable = [
        'title',
        'subtitle',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
