<?php

namespace App\Filament\Resources\AboutQualixceSectionResource\Pages;

use App\Filament\Resources\AboutQualixceSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutQualixceSection extends CreateRecord
{
    protected static string $resource = AboutQualixceSectionResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
