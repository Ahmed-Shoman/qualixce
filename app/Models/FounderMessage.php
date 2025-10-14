<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FounderMessage extends Model
{
    use HasTranslations;

    // Fillable fields for mass assignment
    protected $fillable = [
        'message',    // corrected from description → message to match DB
        'name',
        'position',
        'image',
    ];

    // Fields that are translatable
    public $translatable = [
        'message',
        'name',
        'position',
    ];

    // Cast JSON fields to arrays automatically
    protected $casts = [
        'message'  => 'array',
        'name'     => 'array',
        'position' => 'array',
    ];
}
