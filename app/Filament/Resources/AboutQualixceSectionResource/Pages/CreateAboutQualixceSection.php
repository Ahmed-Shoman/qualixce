<?php

namespace App\Filament\Resources\AboutQualixceSectionResource\Pages;

use App\Filament\Resources\AboutQualixceSectionResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutQualixceSection extends CreateRecord
{
    protected static string $resource = AboutQualixceSectionResource::class;

    /**
     * Redirect to index after saving
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Define form actions (Save / Cancel)
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
     * ✅ Optional: prevent creating multiple AboutQualixceSection records
     * (enable if only one section should exist)
     */
    public static function canCreateAnother(): bool
    {
        return false;
    }

}
