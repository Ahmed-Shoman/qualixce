<?php
// Creation: API Resource for OurValueSection
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OurValueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ar' => [
                'cards' => $this->cards ? collect($this->cards)->map(fn($c) => [
                    'title' => $c['title']['ar'] ?? null,
                    'subtitle' => $c['subtitle']['ar'] ?? null,
                ]) : [],
            ],
            'en' => [
                'cards' => $this->cards ? collect($this->cards)->map(fn($c) => [
                    'title' => $c['title']['en'] ?? null,
                    'subtitle' => $c['subtitle']['en'] ?? null,
                ]) : [],
            ],
        ];
    }
}