<?php

namespace App\Filament\Resources\ProvenProcessResource\Pages;

use App\Filament\Resources\ProvenProcessResource;
use App\Models\ProvenProcess;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListProvenProcesses extends ListRecords
{
    protected static string $resource = ProvenProcessResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no records exist → redirect to create page
        if (ProvenProcess::count() === 0) {
            $this->redirect(ProvenProcessResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Disable the "Create" button if a record already exists
        if (ProvenProcess::count() >= 1) {
            return [];
        }

        // ✅ Show "Create" button only when there are no records
        return [
            CreateAction::make()->label(__('Add Proven Process')),
        ];
    }
}
