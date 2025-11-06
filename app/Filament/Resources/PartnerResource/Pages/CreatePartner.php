<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreatePartner extends CreateRecord
{
    protected static string $resource = PartnerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            // ✅ Save Button
            $this->getCreateFormAction()
                ->label(__('Save'))
                ->color('primary'),

            // ✅ Cancel Button
            Action::make('cancel')
                ->label(__('Cancel'))
                ->color('secondary')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    public static function canCreateAnother(): bool
    {
        return false;
    }
}
