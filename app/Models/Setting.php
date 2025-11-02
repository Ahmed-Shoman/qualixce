<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'primary_color_light',
        'secondary_color_light',
        'primary_color_dark',
        'secondary_color_dark',
        'font_family_ar',
        'font_family_en',
    ];

    protected $casts = [
        'primary_color_light' => 'string',
        'secondary_color_light' => 'string',
        'primary_color_dark' => 'string',
        'secondary_color_dark' => 'string',
        'font_family_ar' => 'string',
        'font_family_en' => 'string',
    ];


    public static function getDefault(): ?self
    {
        return self::first();
    }


    public function getColorsForMode(string $mode = 'light'): array
    {
        return $mode === 'dark'
            ? [
                'primary' => $this->primary_color_dark,
                'secondary' => $this->secondary_color_dark,
            ]
            : [
                'primary' => $this->primary_color_light,
                'secondary' => $this->secondary_color_light,
            ];
    }


    public function getFontForLocale(string $locale = 'en'): ?string
    {
        return $locale === 'ar' ? $this->font_family_ar : $this->font_family_en;
    }
}
