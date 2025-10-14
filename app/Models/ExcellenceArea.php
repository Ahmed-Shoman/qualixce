<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ExcellenceArea extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'subtitle', 'cards'];

    public $translatable = ['title', 'subtitle'];

    protected $casts = [
        'cards' => 'array',
    ];
}
