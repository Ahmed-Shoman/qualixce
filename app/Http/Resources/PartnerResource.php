<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = config('app.locales', ['en', 'ar']);

        $data = [];

        foreach ($locales as $locale) {
            $images = collect($this->images ?? [])
                ->map(fn($img) => [
                    'url' => $img['image'] ?? null,
                ])
                ->values();

            $data[$locale] = [
                'title' => $this->getTranslation('title', $locale),
                'subtitle' => $this->getTranslation('subtitle', $locale),
                'images' => $images,
            ];
        }

        return $data;
    }
}