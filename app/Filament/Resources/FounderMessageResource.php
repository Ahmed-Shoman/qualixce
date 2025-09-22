<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FounderMessageResource\Pages;
use App\Models\FounderMessage;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Card;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class FounderMessageResource extends Resource
{
    protected static ?string $model = FounderMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Founder Message';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->required(),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(4)
                    ->required(),

                TextInput::make('name')
                    ->label('Name')
                    ->required(),

                TextInput::make('position')
                    ->label('Position')
                    ->required(),

                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('founder-messages')
                    ->imagePreviewHeight('120'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->label('Title')
                ->limit(50)
                ->searchable(),

            TextColumn::make('name')
                ->label('Name'),

            TextColumn::make('position')
                ->label('Position'),

            ImageColumn::make('image')
                ->label('Image')
                ->rounded(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFounderMessages::route('/'),
            'create' => Pages\CreateFounderMessage::route('/create'),
            'edit' => Pages\EditFounderMessage::route('/{record}/edit'),
        ];
    }
}