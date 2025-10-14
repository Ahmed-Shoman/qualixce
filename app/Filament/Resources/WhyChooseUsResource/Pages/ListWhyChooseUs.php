<?php

namespace App\Filament\Resources\WhyChooseUsResource\Pages;

use App\Filament\Resources\WhyChooseUsResource;
use App\Models\WhyChooseUs;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListWhyChooseUs extends ListRecords
{
    protected static string $resource = WhyChooseUsResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no records exist → redirect to create page
        if (WhyChooseUs::count() === 0) {
            $this->redirect(WhyChooseUsResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Disable the "Create" button if a record already exists
        if (WhyChooseUs::count() >= 1) {
            return [];
        }

        // ✅ Show "Create" button only when there are no records
        return [
            CreateAction::make()->label(__('Add Why Choose Us')),
        ];
    }
}
