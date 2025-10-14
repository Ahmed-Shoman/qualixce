<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcellenceAreaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = config('app.locales', ['ar', 'en']);

        $data = [];

        foreach ($locales as $locale) {
            $cards = $this->cards[$locale] ?? []; // get cards for this locale

            $data[$locale] = [
                'title' => $this->getTranslation('title', $locale),
                'subtitle' => $this->getTranslation('subtitle', $locale),
                'cards' => collect($cards)
                    ->map(fn($card) => [
                        'title' => $card['title'] ?? null,
                        'subtitle' => $card['subtitle'] ?? null,
                        'description' => $card['description'] ?? null,
                        'points' => $card['points'] ?? [],
                    ])
                    ->values(),
            ];
        }

        return $data;
    }
}
