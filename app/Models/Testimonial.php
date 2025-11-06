<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory, HasTranslations;

    // ✅ Only the actual translatable columns on your table
    public $translatable = [
        'title',
        'subtitle',
    ];

    protected $fillable = [
        'title',
        'subtitle',
        'clients', // JSON array of client data
        'is_active',
    ];

    protected $casts = [
        'clients' => 'array',   // important for Repeater / API
        'is_active' => 'boolean',
    ];
}
