<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurServiceResource\Pages;
use App\Models\OurService;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Card;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class OurServiceResource extends Resource
{
    protected static ?string $model = OurService::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Our Services';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make([
                TextInput::make('title')
                    ->label('Title')
                    ->required(),

                TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->required(),

                Repeater::make('cards')
                    ->label('Cards')
                    ->collapsible()
                    ->schema([
                        TextInput::make('icon')
                            ->label('Icon'),

                        TextInput::make('title')
                            ->label('Card Title')
                            ->required(),

                        TextInput::make('subtitle')
                            ->label('Card Subtitle')
                            ->required(),
                    ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->label('Title')
                ->limit(50),

            TextColumn::make('subtitle')
                ->label('Subtitle')
                ->limit(50),

            TextColumn::make('cards')
                ->label('Cards')
                ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' Cards' : 0),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOurServices::route('/'),
            'create' => Pages\CreateOurService::route('/create'),
            'edit' => Pages\EditOurService::route('/{record}/edit'),
        ];
    }
}