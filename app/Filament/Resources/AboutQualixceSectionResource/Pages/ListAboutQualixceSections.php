<?php

namespace App\Filament\Resources\AboutQualixceSectionResource\Pages;

use App\Filament\Resources\AboutQualixceSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutQualixceSections extends ListRecords
{
    protected static string $resource = AboutQualixceSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(), // ← هذا الزر هو الـ Switcher

        ];
    }

}