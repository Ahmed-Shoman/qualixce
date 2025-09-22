<?php

namespace App\Filament\Resources\FounderMessageResource\Pages;

use App\Filament\Resources\FounderMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFounderMessages extends ListRecords
{
    protected static string $resource = FounderMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
