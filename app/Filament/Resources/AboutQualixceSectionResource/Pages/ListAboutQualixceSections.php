<?php

namespace App\Filament\Resources\AboutQualixceSectionResource\Pages;

use App\Filament\Resources\AboutQualixceSectionResource;
use App\Models\AboutQualixceSection;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;

class ListAboutQualixceSections extends ListRecords
{
    protected static string $resource = AboutQualixceSectionResource::class;

    /**
     * ✅ Automatically redirect to Create page if no records exist
     */
    public function mount(): void
    {
        parent::mount();

        if (AboutQualixceSection::count() === 0) {
            $this->redirect(AboutQualixceSectionResource::getUrl('create'));
        }
    }

    /**
     * ✅ Control header actions (Create + Locale Switcher)
     */
    protected function getHeaderActions(): array
    {
        // Hide Create button if a record already exists
        if (AboutQualixceSection::count() >= 1) {

        }

        // Show Create button only if no records exist
        return [
            CreateAction::make()
                ->label(__('Add About Qualixce Section')),
          
        ];
    }
}
