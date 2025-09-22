<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhyChooseUsResource\Pages;
use App\Models\WhyChooseUs;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Card;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class WhyChooseUsResource extends Resource
{
    protected static ?string $model = WhyChooseUs::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Why Choose Us';

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
                        TextInput::make('icon')->label('Icon'),
                        TextInput::make('title')->label('Card Title')->required(),
                        TextInput::make('subtitle')->label('Card Subtitle')->required(),
                    ])
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
{
    return $table->columns([
        TextColumn::make('title')->label('Title')->limit(50),
        TextColumn::make('subtitle')->label('Subtitle')->limit(50),

        // For cards
        TextColumn::make('cards')
            ->label('Cards')
            ->formatStateUsing(function ($state) {
                if (!is_array($state)) return 0;
                return count($state) . ' Cards';
            }),
    ]);
}


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhyChooseUs::route('/'),
            'create' => Pages\CreateWhyChooseUs::route('/create'),
            'edit' => Pages\EditWhyChooseUs::route('/{record}/edit'),
        ];
    }
}
