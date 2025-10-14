<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OurValueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $cards = $this->cards ?? [];

        return [
            'en' => [
                'cards' => array_map(fn($c) => [
                    'title' => $c['title']['en'] ?? null,
                    'subtitle' => $c['subtitle']['en'] ?? null,
                ], $cards),
            ],
            'ar' => [
                'cards' => array_map(fn($c) => [
                    'title' => $c['title']['ar'] ?? null,
                    'subtitle' => $c['subtitle']['ar'] ?? null,
                ], $cards),
            ],
        ];
    }
}
