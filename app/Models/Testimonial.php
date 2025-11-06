<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'subtitle', 'cards'];

    public $translatable = ['title', 'subtitle'];

    protected $casts = [
        'cards' => 'array',
    ];
}