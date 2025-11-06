<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = config('app.locales', ['ar', 'en']);
        $data = [];

        foreach ($locales as $locale) {
            $cards = $this->cards ?? [];

            $data[$locale] = [
                'title'        => $this->getTranslation('title', $locale),
                'subtitle'     => $this->getTranslation('subtitle', $locale),
                'client_name'  => $this->getTranslation('client_name', $locale),
                'client_role'  => $this->getTranslation('client_role', $locale),
                'cards'        => collect($cards)->map(fn($card) => [
                    'image_url'   => $card['image_url'] ?? null,
                    'description' => $card['description'] ?? null,
                    'stars'       => (int)($card['stars'] ?? 0),
                ])->values(),
            ];
        }

        return [
            'id'         => $this->id,
            'is_active'  => (bool) $this->is_active,
            'translations' => $data,
        ];
    }
}