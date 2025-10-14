<?php

namespace App\Filament\Resources\OurServiceResource\Pages;

use App\Filament\Resources\OurServiceResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateOurService extends CreateRecord
{
    protected static string $resource = OurServiceResource::class;

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

    // ✅ Optional: prevent adding multiple records if needed
    public static function canCreateAnother(): bool
    {
        return true; // change to false if only 1 record should exist
    }
}
