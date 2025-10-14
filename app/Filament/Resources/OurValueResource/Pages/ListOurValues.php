<?php

namespace App\Filament\Resources\OurValueResource\Pages;

use App\Filament\Resources\OurValueResource;
use App\Models\OurValue;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOurValues extends ListRecords
{
    protected static string $resource = OurValueResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no records exist → redirect to create page
        if (OurValue::count() === 0) {
            $this->redirect(OurValueResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Disable "Create" button if a record already exists
        if (OurValue::count() >= 1) {
            return [];
        }

        // ✅ Show "Create" button only when there are no records
        return [
            CreateAction::make()->label(__('Add Our Value')),
        ];
    }
}
