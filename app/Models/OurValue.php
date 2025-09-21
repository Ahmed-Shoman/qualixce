<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OurValue extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['cards'];

    public $translatable = ['cards']; // title & subtitle inside cards
}