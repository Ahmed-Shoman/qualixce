<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory, HasTranslations;


    protected $fillable = [
        'title',
        'subtitle',
        'client_name',
        'client_role',
        'cards',
        'is_active',
    ];


    public $translatable = [
        'title',
        'subtitle',
        'client_name',
        'client_role',
    ];


    protected $casts = [
        'cards' => 'array',
        'is_active' => 'boolean',
    ];
}