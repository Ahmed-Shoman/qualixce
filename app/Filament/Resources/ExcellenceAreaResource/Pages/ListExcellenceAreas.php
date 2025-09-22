<?php

namespace App\Filament\Resources\ExcellenceAreaResource\Pages;

use App\Filament\Resources\ExcellenceAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExcellenceAreas extends ListRecords
{
    protected static string $resource = ExcellenceAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
