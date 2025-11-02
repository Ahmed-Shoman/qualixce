<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'colors' => [
                'light' => [
                    'primary' => $this->primary_color_light,
                    'secondary' => $this->secondary_color_light,
                ],
                'dark' => [
                    'primary' => $this->primary_color_dark,
                    'secondary' => $this->secondary_color_dark,
                ],
            ],
            'fonts' => [
                'ar' => $this->font_family_ar,
                'en' => $this->font_family_en,
            ],
            'updated_at' => $this->updated_at?->format('Y-m-d H:i'),
        ];
    }
}