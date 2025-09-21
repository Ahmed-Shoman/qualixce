<?php
// API Resource: AboutQualixceSectionResource.php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutQualixceSectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ar' => [
                'title' => $this->getTranslation('title', 'ar'),
                'subtitle' => $this->getTranslation('subtitle', 'ar'),
                'cards' => $this->getTranslation('cards', 'ar'),
                'image' => $this->image ? asset('storage/' . $this->image) : null,
                'image_alt' => $this->getTranslation('image_alt', 'ar'),
            ],
            'en' => [
                'title' => $this->getTranslation('title', 'en'),
                'subtitle' => $this->getTranslation('subtitle', 'en'),
                'cards' => $this->getTranslation('cards', 'en'),
                'image' => $this->image ? asset('storage/' . $this->image) : null,
                'image_alt' => $this->getTranslation('image_alt', 'en'),
            ],
        ];
    }
}