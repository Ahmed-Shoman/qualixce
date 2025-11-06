<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'image',
        'image_alt',
        'is_active',
        'writer',
        'category',
        'slug',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'content',
        'image_alt',
        'slug'
    ];
}
