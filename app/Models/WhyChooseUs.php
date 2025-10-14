<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WhyChooseUs extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'subtitle', 'cards'];

    public $translatable = ['title', 'subtitle']; // remove 'cards'

    protected $casts = [
        'cards' => 'array',
    ];

    // Add this method to handle cards translations
    public function getCards(string $locale = 'en'): array
    {
        if (!is_array($this->cards)) {
            return [];
        }

        return collect($this->cards)->map(function ($card) use ($locale) {
            return [
                'title' => $card['title'][$locale] ?? null,
                'subtitle' => $card['subtitle'][$locale] ?? null,
            ];
        })->toArray();
    }
}
