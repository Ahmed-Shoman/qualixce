<?php

namespace App\Filament\Resources\ProvenProcessResource\Pages;

use App\Filament\Resources\ProvenProcessResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProvenProcesses extends ListRecords
{
    protected static string $resource = ProvenProcessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
