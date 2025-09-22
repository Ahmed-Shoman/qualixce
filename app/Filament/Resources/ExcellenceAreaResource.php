<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExcellenceAreaResource\Pages;
use App\Models\ExcellenceArea;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Card;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ExcellenceAreaResource extends Resource
{
    protected static ?string $model = ExcellenceArea::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Excellence Areas';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make([
                TextInput::make('title')->label('Title')->required(),
                TextInput::make('subtitle')->label('Subtitle')->required(),

                Repeater::make('cards')
                    ->label('Cards')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title')->label('Card Title')->required(),
                        TextInput::make('subtitle')->label('Card Subtitle')->required(),
                        Textarea::make('description')->label('Description')->required(),
                        Repeater::make('points')
                            ->label('Points')
                            ->schema([
                                TextInput::make('point')->label('Point')->required()
                            ])
                            ->columnSpanFull(),
                    ])
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Title')->limit(50),
            TextColumn::make('subtitle')->label('Subtitle')->limit(50),
            TextColumn::make('cards')
                ->label('Cards')
                ->formatStateUsing(fn($state) => is_array($state) ? count($state) . ' Cards' : 0),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExcellenceAreas::route('/'),
            'create' => Pages\CreateExcellenceArea::route('/create'),
            'edit' => Pages\EditExcellenceArea::route('/{record}/edit'),
        ];
    }
}