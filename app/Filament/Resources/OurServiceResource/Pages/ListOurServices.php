<?php

namespace App\Filament\Resources\OurServiceResource\Pages;

use App\Filament\Resources\OurServiceResource;
use App\Models\OurService;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListOurServices extends ListRecords
{
    protected static string $resource = OurServiceResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no records exist → redirect to create page
        if (OurService::count() === 0) {
            $this->redirect(OurServiceResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Disable the "Create" button if a record already exists
        if (OurService::count() >= 1) {
            return [];
        }

        // ✅ Show "Create" button only when there are no records
        return [
            CreateAction::make()->label(__('Add Our Service')),
        ];
    }
}
