<?php

namespace App\Filament\Resources\ProvenProcessResource\Pages;

use App\Filament\Resources\ProvenProcessResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateProvenProcess extends CreateRecord
{
    protected static string $resource = ProvenProcessResource::class;

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

    // ✅ Optional: prevent multiple Proven Process records if needed
    public static function canCreateAnother(): bool
    {
        return true; // set to false if you want to allow only one
    }
}
