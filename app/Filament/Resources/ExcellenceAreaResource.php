<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExcellenceAreaResource\Pages;
use App\Models\ExcellenceArea;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ExcellenceAreaResource extends Resource
{
    protected static ?string $model = ExcellenceArea::class;

    protected static ?string $navigationIcon  = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Excellence Areas';
    protected static ?string $pluralLabel     = 'Excellence Areas';
    protected static ?string $modelLabel      = 'Excellence Area';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        $locales = self::getTranslatableLocales();

        return $form->schema([
            Section::make(__('Texts'))
                ->description(__('Main title and subtitle for Excellence Area'))
                ->icon('heroicon-o-document-text')
                ->collapsible()
                ->schema([
                    Tabs::make('Translations')
                        ->tabs(array_map(function ($locale) {
                            return Tabs\Tab::make(strtoupper($locale))
                                ->schema([
                                    TextInput::make("title.{$locale}")
                                        ->label(__('Title') . " (" . strtoupper($locale) . ")")
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make("subtitle.{$locale}")
                                        ->label(__('Subtitle') . " (" . strtoupper($locale) . ")")
                                        ->required()
                                        ->maxLength(255),

                                    Repeater::make("cards.{$locale}")
                                        ->label(__('Fields'))
                                        ->required()
                                        ->reorderable()
                                        ->minItems(1)
                                        ->cloneable()
                                        ->itemLabel(fn(array $state) => $state['title'] ?? null)
                                        ->schema([
                                            TextInput::make('title')
                                                ->label(__('Field Title'))
                                                ->required()
                                                ->maxLength(255),

                                            TextInput::make('subtitle')
                                                ->label(__('Field Iso Numbers'))
                                                ->required()
                                                ->maxLength(255),

                                            Textarea::make('description')
                                                ->label(__('Description'))
                                                ->required()
                                                ->rows(3),

                                            Repeater::make('points')
                                                ->label(__('Features'))
                                                ->required()
                                                ->schema([
                                                    TextInput::make('point')
                                                        ->label(__('Feature'))
                                                        ->required(),
                                                ])
                                                ->columns(1),
                                        ])
                                        ->columns(1),
                                ]);
                        }, $locales)),
                ])
                ->columns(1),
        ]);
    }

    /**
     * ---------- Table ----------
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title (EN)'))
                    ->formatStateUsing(fn($record) => $record->getTranslation('title', 'en'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                TextColumn::make('title')
                    ->label(__('Title (AR)'))
                    ->formatStateUsing(fn($record) => $record->getTranslation('title', 'ar'))
                    ->color('gray')
                    ->wrap(),

                TextColumn::make('cards')
                    ->label(__('Number of Cards'))
                    ->formatStateUsing(fn($record) => count($record->cards ?? []))
                    ->sortable(),
            ])
            ->striped()
            ->actions([
                \Filament\Tables\Actions\ViewAction::make()->label(__('View')),
                \Filament\Tables\Actions\EditAction::make()->label(__('Edit')),
                \Filament\Tables\Actions\DeleteAction::make()->label(__('Delete')),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\DeleteBulkAction::make()->label(__('Delete Selected')),
            ]);
    }

    /**
     * ---------- Pages ----------
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListExcellenceAreas::route('/'),
            'create' => Pages\CreateExcellenceArea::route('/create'),
            'edit'   => Pages\EditExcellenceArea::route('/{record}/edit'),
        ];
    }
}
