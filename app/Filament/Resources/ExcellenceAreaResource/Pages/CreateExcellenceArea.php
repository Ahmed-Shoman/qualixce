<?php

namespace App\Filament\Resources\ExcellenceAreaResource\Pages;

use App\Filament\Resources\ExcellenceAreaResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateExcellenceArea extends CreateRecord
{
    protected static string $resource = ExcellenceAreaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            // ✅ Save button
            $this->getCreateFormAction()
                ->label(__('Save'))
                ->color('primary'),

            // ✅ Cancel button
            Action::make('cancel')
                ->label(__('Cancel'))
                ->color('secondary')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    // ✅ Prevent adding multiple excellence areas if needed
    public static function canCreateAnother(): bool
    {
        return true; // set to false if you want only one record
    }
}
