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
                'message' => $this->getTranslation('message', 'ar'),
                'name' => $this->getTranslation('name', 'ar'),
                'position' => $this->getTranslation('position', 'ar'),
                'image' => $this->image,
            ],
            'en' => [
                'message' => $this->getTranslation('message', 'en'),
                'name' => $this->getTranslation('name', 'en'),
                'position' => $this->getTranslation('position', 'en'),
                'image' => $this->image,
            ],
        ];
    }
}
