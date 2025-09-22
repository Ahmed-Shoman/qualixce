<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WhyChooseUs extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'subtitle', 'cards'];

    public $translatable = ['title', 'subtitle', 'cards'];

    protected $casts = [
        'cards' => 'array',
    ];
}