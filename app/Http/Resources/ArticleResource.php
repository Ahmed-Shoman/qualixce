<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = config('app.locales', ['ar', 'en']);
        $data = [];

        foreach ($locales as $locale) {
            $data[$locale] = [
                'title'       => $this->getTranslation('title', $locale),
                'subtitle'    => $this->getTranslation('subtitle', $locale),
                'content'     => $this->getTranslation('content', $locale),
                'image_alt'   => $this->getTranslation('image_alt', $locale),
                'image'       => $this->image ? asset('storage/' . $this->image) : null,
            ];
        }

        $data['id'] = $this->id;
        $data['created_at'] = $this->created_at;
        $data['updated_at'] = $this->updated_at;

        return $data;
    }
}