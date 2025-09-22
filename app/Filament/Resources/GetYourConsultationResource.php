<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GetYourConsultationResource\Pages;
use App\Models\GetYourConsultation;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class GetYourConsultationResource extends Resource
{
    protected static ?string $model = GetYourConsultation::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationLabel = 'Consultation Requests';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label('Name')->required(),
            TextInput::make('mobile_phone')->label('Mobile Phone')->tel()->required(),
            TextInput::make('email')->label('Email')->email()->required(),
            Textarea::make('message')->label('Message')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Name')->searchable(),
            TextColumn::make('mobile_phone')->label('Mobile Phone'),
            TextColumn::make('email')->label('Email'),
            TextColumn::make('message')->label('Message')->limit(50),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGetYourConsultations::route('/'),
            'create' => Pages\CreateGetYourConsultation::route('/create'),
            'edit' => Pages\EditGetYourConsultation::route('/{record}/edit'),
        ];
    }
}
