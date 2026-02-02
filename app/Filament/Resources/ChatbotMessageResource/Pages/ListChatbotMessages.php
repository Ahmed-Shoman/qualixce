<?php

namespace App\Filament\Resources\ChatbotMessageResource\Pages;

use App\Filament\Resources\ChatbotMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChatbotMessages extends ListRecords
{
    protected static string $resource = ChatbotMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
