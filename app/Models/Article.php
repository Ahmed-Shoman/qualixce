<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'image',
        'image_alt',
        'is_active',
        'writer',
        'category',
        'slug',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'content',
        'image_alt',
    ];

    /**
     * Automatically generate a slug from the English title if not provided.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->getTranslation('title', 'en'));
            }
        });

        static::updating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->getTranslation('title', 'en'));
            }
        });
    }

    /**
     * Get full image URL.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}