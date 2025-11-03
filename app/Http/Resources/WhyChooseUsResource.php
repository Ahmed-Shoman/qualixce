<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WhyChooseUsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = config('app.locales', ['ar', 'en']);

        $data = [];

        foreach ($locales as $locale) {
            $data[$locale] = [
                'title'    => $this->getTranslation('title', $locale),
                'subtitle' => $this->getTranslation('subtitle', $locale),
                'cards'    => collect($this->cards ?? [])->map(function ($card) use ($locale) {
                    return [
                        'icon'     => $card['icon'] ?? null,
                        'title'    => $card['title'][$locale] ?? null,
                        'subtitle' => $card['subtitle'][$locale] ?? null,
                    ];
                })->values(),
            ];
        }

        return $data;
    }
}