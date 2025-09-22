<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FounderMessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ar' => [
                'title' => $this->getTranslation('title', 'ar'),
                'description' => $this->getTranslation('description', 'ar'),
                'name' => $this->getTranslation('name', 'ar'),
                'position' => $this->getTranslation('position', 'ar'),
                'image' => $this->image,
            ],
            'en' => [
                'title' => $this->getTranslation('title', 'en'),
                'description' => $this->getTranslation('description', 'en'),
                'name' => $this->getTranslation('name', 'en'),
                'position' => $this->getTranslation('position', 'en'),
                'image' => $this->image,
            ],
        ];
    }
}