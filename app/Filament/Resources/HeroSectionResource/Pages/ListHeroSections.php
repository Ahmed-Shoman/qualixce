<?php

namespace App\Filament\Resources\HeroSectionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\HeroSectionResource;
use App\Models\HeroSection;

class ListHeroSections extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = HeroSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn () => HeroSection::count() === 0), // يظهر فقط لو مفيش بيانات
            Actions\LocaleSwitcher::make(),
        ];
    }
}