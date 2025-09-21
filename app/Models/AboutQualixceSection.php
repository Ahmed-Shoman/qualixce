<?php
// Model: AboutQualixceSection.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutQualixceSection extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'cards',
        'image',
        'image_alt',
    ];

    public $translatable = ['title', 'subtitle', 'cards', 'image_alt'];

    protected $casts = [
        'cards' => 'array',
    ];
}
