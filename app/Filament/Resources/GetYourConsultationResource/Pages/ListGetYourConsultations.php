<?php

namespace App\Filament\Resources\GetYourConsultationResource\Pages;

use App\Filament\Resources\GetYourConsultationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGetYourConsultations extends ListRecords
{
    protected static string $resource = GetYourConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
