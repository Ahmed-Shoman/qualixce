<?php

namespace App\Filament\Resources\HeroSectionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\HeroSectionResource;

class CreateHeroSection extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = HeroSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}