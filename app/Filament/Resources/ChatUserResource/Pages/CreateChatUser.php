<?php

namespace App\Filament\Resources\ChatUserResource\Pages;

use App\Filament\Resources\ChatUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChatUser extends CreateRecord
{
    protected static string $resource = ChatUserResource::class;
}
