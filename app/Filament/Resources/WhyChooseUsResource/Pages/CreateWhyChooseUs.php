<?php

namespace App\Filament\Resources\WhyChooseUsResource\Pages;

use App\Filament\Resources\WhyChooseUsResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateWhyChooseUs extends CreateRecord
{
    protected static string $resource = WhyChooseUsResource::class;

    /**
     * Redirect to the resource index after saving.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Customize the form actions (Save & Cancel).
     */
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

    /**
     * ✅ Optional: Prevent adding multiple records if needed.
     */
    public static function canCreateAnother(): bool
    {
        return false;
    }
}
