<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = ['en', 'ar'];

        // Section translations
        $translations = [];
        foreach ($locales as $locale) {
            $translations[$locale] = [
                'title'    => $this->getTranslation('title', $locale),
                'subtitle' => $this->getTranslation('subtitle', $locale),
            ];
        }

        // Clients (cards)
        $cards = [];
        if (!empty($this->clients)) {
            foreach ($this->clients as $client) {
                $clientData = [
                    'image' => $client['image'] ?? null,
                    'stars' => $client['stars'] ?? 5,
                    'translations' => [],
                ];

                foreach ($locales as $locale) {
                    $clientData['translations'][$locale] = [
                        'client_name' => $client['client_name'][$locale] ?? null,
                        'client_role' => $client['client_role'][$locale] ?? null,
                        'review_text' => $client['review_text'][$locale] ?? null,
                    ];
                }

                $cards[] = $clientData;
            }
        }

        return [
            'id'           => $this->id,
            'translations' => $translations,
            'cards'        => $cards,
            'is_active'    => (bool) $this->is_active,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}