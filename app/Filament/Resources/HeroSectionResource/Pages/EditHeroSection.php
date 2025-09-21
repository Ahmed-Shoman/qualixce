<?php

namespace App\Filament\Resources\HeroSectionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\HeroSectionResource;

class EditHeroSection extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = HeroSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}