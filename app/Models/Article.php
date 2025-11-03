<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'image',
        'image_alt',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'content',
        'image_alt',
    ];
}