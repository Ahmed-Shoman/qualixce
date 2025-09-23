<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurValueResource\Pages;
use App\Models\OurValue;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class OurValueResource extends Resource
{
    use Translatable;

    protected static ?string $model = OurValue::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Our Values';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Big card wrapping the Repeater
            Card::make([
                Repeater::make('cards')
                    ->label('Cards')
                    ->columns(2) // two columns layout
                    ->collapsible()
                    ->schema([
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
            // Display each card in a nicer way
            TextColumn::make('cards')
                ->label('Cards')
                ->formatStateUsing(function ($state) {
                    if (!is_array($state)) return '';
                    $output = '';
                    foreach ($state as $card) {
                        $output .= '<strong>' . e($card['title'] ?? '') . '</strong>: ' . e($card['subtitle'] ?? '') . '<br>';
                    }
                    return $output;
                })
                ->html() // render as HTML
                ->limit(200),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOurValues::route('/'),
            'create' => Pages\CreateOurValue::route('/create'),
            'edit' => Pages\EditOurValue::route('/{record}/edit'),
        ];
    }
}