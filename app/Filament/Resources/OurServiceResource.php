<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurServiceResource\Pages;
use App\Models\OurService;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class OurServiceResource extends Resource
{
    protected static ?string $model = OurService::class;

    protected static ?string $navigationIcon  = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Our Services';
    protected static ?string $pluralLabel     = 'Our Services';
    protected static ?string $modelLabel      = 'Our Service';

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('Service Information'))
                ->description(__('Enter service information and its cards'))
                ->icon('heroicon-o-cog')
                ->collapsible()
                ->schema([
                    Tabs::make('Translations')
                        ->tabs([
                            Tab::make('English')->schema([
                                TextInput::make('title.en')
                                    ->label(__('Title (EN)'))
                                    ->required()
                                    ->maxLength(150),

                                TextInput::make('subtitle.en')
                                    ->label(__('Subtitle (EN)'))
                                    ->required()
                                    ->maxLength(250),

                                Repeater::make('cards.en')
                                    ->label(__('Cards (EN)'))
                                    ->minItems(1)
                                    ->reorderable()
                                    ->cloneable()
                                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label(__('Card Title'))
                                            ->required()
                                            ->maxLength(150),

                                        TextInput::make('subtitle')
                                            ->label(__('Card Subtitle'))
                                            ->required()
                                            ->maxLength(250),
                                    ])
                                    ->columns(1)
                                    ->collapsed(false)
                                    ->collapsible(),
                            ]),

                            Tab::make('Arabic')->schema([
                                TextInput::make('title.ar')
                                    ->label(__('Title (AR)'))
                                    ->required()
                                    ->maxLength(150)
                                    ->extraAttributes(['dir' => 'rtl']),

                                TextInput::make('subtitle.ar')
                                    ->label(__('Subtitle (AR)'))
                                    ->required()
                                    ->maxLength(250)
                                    ->extraAttributes(['dir' => 'rtl']),

                                Repeater::make('cards.ar')
                                    ->label(__('Cards (AR)'))
                                    ->minItems(1)
                                    ->reorderable()
                                    ->cloneable()
                                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label(__('Card Title'))
                                            ->required()
                                            ->maxLength(150),

                                        TextInput::make('subtitle')
                                            ->label(__('Card Subtitle'))
                                            ->required()
                                            ->maxLength(250),
                                    ])
                                    ->columns(1)
                                    ->collapsed(false)
                                    ->collapsible(),
                            ]),
                        ]),
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
                    ->wrap(),

                TextColumn::make('title')
                    ->label(__('Title (AR)'))
                    ->formatStateUsing(fn($record) => $record->getTranslation('title', 'ar'))
                    ->color('gray')
                    ->wrap(),

                // TextColumn::make('cards')
                //     ->label(__('Cards'))
                //     ->formatStateUsing(fn($state) => is_array($state) ? count($state) . ' Card(s)' : '0 Cards'),
            ])
            ->actions([
                ViewAction::make()->label(__('View')),
                EditAction::make()->label(__('Edit')),
                DeleteAction::make()->label(__('Delete'))->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()->label(__('Delete Selected')),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped();
    }

    /**
     * ---------- Pages ----------
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOurServices::route('/'),
            'create' => Pages\CreateOurService::route('/create'),
            'edit'   => Pages\EditOurService::route('/{record}/edit'),
        ];
    }
}
