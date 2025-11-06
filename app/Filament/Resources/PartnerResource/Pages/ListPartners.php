<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use App\Models\Partner;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListPartners extends ListRecords
{
    protected static string $resource = PartnerResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no records exist → redirect to create page
        if (Partner::count() === 0) {
            $this->redirect(PartnerResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Disable the "Create" button if a record already exists
        if (Partner::count() >= 1) {
            return [];
        }

        // ✅ Show Create button only when there are no records
        return [
            CreateAction::make()
                ->label(__('Add Partner')),
        ];
    }
}
