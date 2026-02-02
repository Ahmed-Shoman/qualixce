<?php

namespace App\Filament\Resources\ChatUserResource\Pages;

use App\Filament\Resources\ChatUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChatUser extends EditRecord
{
    protected static string $resource = ChatUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
