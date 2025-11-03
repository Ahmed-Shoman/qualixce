<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutQualixceSectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ar' => [
                'title'     => $this->getTranslation('title', 'ar'),
                'subtitle'  => $this->getTranslation('subtitle', 'ar'),
                'cards'     => collect($this->cards)->map(function ($card) {
                    return [
                        'title'    => $card['title']['ar'] ?? null,
                        'subtitle' => $card['subtitle']['ar'] ?? null,
                        'icon'     => isset($card['icon'])
                            ? asset('storage/' . $card['icon'])
                            : null,
                    ];
                }),
                'image'     => $this->image ? asset('storage/' . $this->image) : null,
                'image_alt' => $this->getTranslation('image_alt', 'ar'),
            ],

            'en' => [
                'title'     => $this->getTranslation('title', 'en'),
                'subtitle'  => $this->getTranslation('subtitle', 'en'),
                'cards'     => collect($this->cards)->map(function ($card) {
                    return [
                        'title'    => $card['title']['en'] ?? null,
                        'subtitle' => $card['subtitle']['en'] ?? null,
                        'icon'     => isset($card['icon'])
                            ? asset('storage/' . $card['icon'])
                            : null,
                    ];
                }),
                'image'     => $this->image ? asset('storage/' . $this->image) : null,
                'image_alt' => $this->getTranslation('image_alt', 'en'),
            ],
        ];
    }
}
