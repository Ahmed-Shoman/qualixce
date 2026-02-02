<?php

namespace App\Filament\Resources\ChatUserResource\Pages;

use App\Filament\Resources\ChatUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChatUsers extends ListRecords
{
    protected static string $resource = ChatUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
