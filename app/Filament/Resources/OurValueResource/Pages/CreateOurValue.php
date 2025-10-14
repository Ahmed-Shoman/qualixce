<?php

namespace App\Filament\Resources\OurValueResource\Pages;

use App\Filament\Resources\OurValueResource;
use App\Models\OurValue;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateOurValue extends CreateRecord
{
    protected static string $resource = OurValueResource::class;

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

    // ✅ Optional: prevent creating multiple OurValue records
    public static function canCreateAnother(): bool
    {
        return OurValue::count() === 0;
    }
}
