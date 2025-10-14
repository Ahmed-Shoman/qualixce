<?php

namespace App\Filament\Resources\FounderMessageResource\Pages;

use App\Filament\Resources\FounderMessageResource;
use App\Models\FounderMessage;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListFounderMessages extends ListRecords
{
    protected static string $resource = FounderMessageResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no records exist → redirect to create page
        if (FounderMessage::count() === 0) {
            $this->redirect(FounderMessageResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Disable the "Create" button if a record already exists
        if (FounderMessage::count() >= 1) {
            return [];
        }

        // ✅ Show "Create" button only when there are no records
        return [
            CreateAction::make()->label(__('Add Founder Message')),
        ];
    }
}
