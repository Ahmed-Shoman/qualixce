<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FounderMessage extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'name',
        'position',
        'image',
    ];

    public $translatable = [
        'title',
        'description',
        'name',
        'position',
    ];
}
