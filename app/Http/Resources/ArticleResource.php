<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locales = config('app.locales', ['ar', 'en']);
        $translations = [];

        foreach ($locales as $locale) {
            $translations[$locale] = [
                'slug'        => $this->getTranslation('slug', $locale),
                'writer'      => $this->getTranslation('writer', $locale),
                'category'    => $this->getTranslation('category', $locale),
                'title'       => $this->getTranslation('title', $locale),
                'subtitle'    => $this->getTranslation('subtitle', $locale),
                'content'     => $this->getTranslation('content', $locale),
                'image_alt'   => $this->getTranslation('image_alt', $locale),
            ];
        }

        return [
            'id'          => $this->id,
            'image'       => $this->image ? asset('storage/' . $this->image) : null,
            'translations'=> $translations,
            'is_active'   => (bool) $this->is_active,
            'created_at'  => $this->created_at->format('Y-m-d H:i'),
            'updated_at'  => $this->updated_at->format('Y-m-d H:i'),
        ];
    }
}
