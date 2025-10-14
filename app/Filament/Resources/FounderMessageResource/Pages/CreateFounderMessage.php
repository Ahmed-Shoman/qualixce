<?php

namespace App\Filament\Resources\FounderMessageResource\Pages;

use App\Filament\Resources\FounderMessageResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateFounderMessage extends CreateRecord
{
    protected static string $resource = FounderMessageResource::class;

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

    // ✅ Prevent adding multiple founder messages
    public static function canCreateAnother(): bool
    {
        return false;
    }
}
