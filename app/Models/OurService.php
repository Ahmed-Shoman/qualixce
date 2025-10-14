<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OurService extends Model
{
    use HasTranslations;

    // Fillable fields
    protected $fillable = ['title', 'subtitle', 'cards'];

    // Translatable fields
    public $translatable = ['title', 'subtitle']; // cards handled manually

    // Casts
    protected $casts = [
        'cards' => 'array', // store as array
    ];
}
