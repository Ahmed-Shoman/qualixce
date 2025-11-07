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
                    'image' => isset($img['image'])
                        ? asset('storage/' . $img['image'])
                        : null,
                    'url' => $img['url'] ?? null,
                ])
                ->filter(fn($img) => $img['image'] !== null)
                ->values();

            $data[$locale] = [
                'title'    => $this->getTranslation('title', $locale),
                'subtitle' => $this->getTranslation('subtitle', $locale),
                'images'   => $images,
            ];
        }

        $data['id']         = $this->id;
        $data['is_active']  = (bool) $this->is_active;
        $data['created_at'] = $this->created_at?->toDateTimeString();
        $data['updated_at'] = $this->updated_at?->toDateTimeString();

        return $data;
    }
}
