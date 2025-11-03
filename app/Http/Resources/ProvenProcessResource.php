<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvenProcessResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = config('app.locales', ['ar', 'en']);

        $data = [];

        foreach ($locales as $locale) {
            $cards = $this->getTranslation('cards', $locale);

            if (!is_array($cards)) {
                $cards = [];
            }

            $data[$locale] = [
                'title' => $this->getTranslation('title', $locale) ?? '',
                'subtitle' => $this->getTranslation('subtitle', $locale) ?? '',
                'cards' => collect($cards)
                    ->map(fn($card) => [
                        'title' => $card['title'] ?? null,
                        'description' => $card['description'] ?? null,
                        'icon' => $card['icon'] ?? null,
                    ])
                    ->values(),
            ];
        }

        return $data;
    }
}
