<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroSectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'background_image' => $this->background_image ? asset('storage/' . $this->background_image) : null,
            'translations' => [
                'ar' => [
                    'title' => $this->getTranslation('title', 'ar'),
                    'subtitle' => $this->getTranslation('subtitle', 'ar'),
                    'background_image_alt' => $this->getTranslation('background_image_alt', 'ar'),
                ],
                'en' => [
                    'title' => $this->getTranslation('title', 'en'),
                    'subtitle' => $this->getTranslation('subtitle', 'en'),
                    'background_image_alt' => $this->getTranslation('background_image_alt', 'en'),
                ],
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}