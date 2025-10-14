<?php

namespace App\Filament\Resources\ExcellenceAreaResource\Pages;

use App\Filament\Resources\ExcellenceAreaResource;
use App\Models\ExcellenceArea;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListExcellenceAreas extends ListRecords
{
    protected static string $resource = ExcellenceAreaResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no records exist → redirect to create page
        if (ExcellenceArea::count() === 0) {
            $this->redirect(ExcellenceAreaResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Disable the "Create" button if a record already exists
        if (ExcellenceArea::count() >= 1) {
            return [];
        }

        // ✅ Show "Create" button only when there are no records
        return [
            CreateAction::make()->label(__('Add Excellence Area')),
        ];
    }
}
