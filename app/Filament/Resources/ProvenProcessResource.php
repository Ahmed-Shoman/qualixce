<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvenProcessResource\Pages;
use App\Models\ProvenProcess;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;

class ProvenProcessResource extends Resource
{
    protected static ?string $model = ProvenProcess::class;

    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Proven Processes';

    public static function getNavigationLabel(): string
    {
        return __('Proven Processes');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Proven Processes');
    }

    public static function getModelLabel(): string
    {
        return __('Proven Process');
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make(__('Texts & Cards'))
                ->description(__('Add / edit the process information in multiple languages'))
                ->schema([
                    Tabs::make('Translations')
                        ->tabs([

                            Tabs\Tab::make('English')->schema([
                                TextInput::make('title.en')
                                    ->label(__('Title (EN)'))
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('subtitle.en')
                                    ->label(__('Subtitle (EN)'))
                                    ->required()
                                    ->maxLength(255),

                                Repeater::make('cards.en')
                                    ->label(__('Cards (EN)'))
                                    ->minItems(1)
                                    ->schema([
                                        TextInput::make('icon')
                                            ->label(__('Icon (class name)'))
                                            ->placeholder('e.g., fa-solid fa-star')
                                            ->maxLength(150),

                                        TextInput::make('title')
                                            ->label(__('Card Title'))
                                            ->required()
                                            ->maxLength(150),

                                        TextInput::make('description')
                                            ->label(__('Card Description'))
                                            ->required()
                                            ->maxLength(500),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),
                            ]),

                            Tabs\Tab::make('Arabic')->schema([
                                TextInput::make('title.ar')
                                    ->label(__('Title (AR)'))
                                    ->required()
                                    ->maxLength(255)
                                    ->extraAttributes(['dir' => 'rtl']),

                                TextInput::make('subtitle.ar')
                                    ->label(__('Subtitle (AR)'))
                                    ->required()
                                    ->maxLength(255)
                                    ->extraAttributes(['dir' => 'rtl']),

                                Repeater::make('cards.ar')
                                    ->label(__('Cards (AR)'))
                                    ->minItems(1)
                                    ->schema([
                                        TextInput::make('icon')
                                            ->label(__('Icon (class name)'))
                                            ->placeholder('مثلاً fa-solid fa-star')
                                            ->maxLength(150)
                                            ->extraAttributes(['dir' => 'rtl']),

                                        TextInput::make('title')
                                            ->label(__('Card Title'))
                                            ->required()
                                            ->maxLength(150)
                                            ->extraAttributes(['dir' => 'rtl']),

                                        TextInput::make('description')
                                            ->label(__('Card Description'))
                                            ->required()
                                            ->maxLength(500)
                                            ->extraAttributes(['dir' => 'rtl']),
                                    ])
                                    ->columns(1)
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
                    ->wrap()
                    ->color('gray'),

                BadgeColumn::make('cards')
                    ->label(__('Cards Count (EN)'))
                    ->formatStateUsing(fn($record) => is_array($record->getTranslation('cards', 'en')) ? count($record->getTranslation('cards', 'en')) . ' Cards' : '0')
                    ->colors([
                        'danger'  => fn($state) => $state < 1,
                        'warning' => fn($state) => $state < 3,
                        'success' => fn($state) => $state >= 3,
                    ]),
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
            'index'  => Pages\ListProvenProcesses::route('/'),
            'create' => Pages\CreateProvenProcess::route('/create'),
            'edit'   => Pages\EditProvenProcess::route('/{record}/edit'),
        ];
    }
}