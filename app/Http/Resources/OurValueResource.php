<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OurValueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'cards' => collect($this->cards ?? [])->map(function ($card) {
                return [
                    'icon' => $card['icon'] ?? null,
                    'title' => [
                        'en' => $card['title']['en'] ?? null,
                        'ar' => $card['title']['ar'] ?? null,
                    ],
                    'subtitle' => [
                        'en' => $card['subtitle']['en'] ?? null,
                        'ar' => $card['subtitle']['ar'] ?? null,
                    ],
                ];
            }),
        ];
    }
}