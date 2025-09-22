<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WhyChooseUsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = config('app.locales', ['ar', 'en']); // define your locales

        $data = [];
        foreach ($locales as $locale) {
            $data[$locale] = [
                'title' => $this->getTranslation('title', $locale),
                'subtitle' => $this->getTranslation('subtitle', $locale),
                'cards' => collect($this->getTranslation('cards', $locale))
                    ->map(function ($card) {
                        return [
                            'icon' => $card['icon'] ?? null,
                            'title' => $card['title'] ?? null,
                            'subtitle' => $card['subtitle'] ?? null,
                        ];
                    }),
            ];
        }

        return $data;
    }
}
