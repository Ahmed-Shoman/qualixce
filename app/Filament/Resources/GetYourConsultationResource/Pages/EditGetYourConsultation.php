<?php

namespace App\Filament\Resources\GetYourConsultationResource\Pages;

use App\Filament\Resources\GetYourConsultationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGetYourConsultation extends EditRecord
{
    protected static string $resource = GetYourConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
