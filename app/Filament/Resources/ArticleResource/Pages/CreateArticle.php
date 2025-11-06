<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

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
        return true; // Set false if you want to prevent multiple articles
    }
}
