<?php

namespace App\Filament\Resources\HeroSectionResource\Pages;

use App\Filament\Resources\HeroSectionResource;
use App\Models\HeroSection;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;


class ListHeroSections extends ListRecords
{
    protected static string $resource = HeroSectionResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no records exist → redirect to create page
        if (HeroSection::count() === 0) {
            $this->redirect(HeroSectionResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Disable the "Create" button if a record already exists
        if (HeroSection::count() >= 1) {
            return [];
        }

        // ✅ Show "Create" button only when there are no records
        return [
            CreateAction::make()->label(__('Add Hero Section')),
        ];
    }
}
