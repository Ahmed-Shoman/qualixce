<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhyChooseUsResource\Pages;
use App\Models\WhyChooseUs;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class WhyChooseUsResource extends Resource
{
    protected static ?string $model = WhyChooseUs::class;

    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Why Choose Us';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Translations')
                ->tabs([
                    Tab::make('English')
                        ->schema([
                            Section::make('Why Choose Us (EN)')
                                ->schema([
                                    TextInput::make('title.en')
                                        ->label('Title (EN)')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('subtitle.en')
                                        ->label('Subtitle (EN)')
                                        ->required()
                                        ->maxLength(255),

                                    Repeater::make('cards')
                                        ->label('Cards (EN)')
                                        ->collapsible()
                                        ->collapsed(false)
                                        ->defaultItems(1)
                                        ->itemLabel(fn(array $state) => $state['title']['en'] ?? 'New Card')
                                        ->reorderable()
                                        ->cloneable()
                                        ->schema([
                                            TextInput::make('title.en')
                                                ->label('Card Title (EN)')
                                                ->required()
                                                ->maxLength(150),

                                            TextInput::make('subtitle.en')
                                                ->label('Card Subtitle (EN)')
                                                ->required()
                                                ->maxLength(250),
                                        ])
                                        ->columns(1),
                                ])
                                ->columns(1),
                        ]),

                    Tab::make('العربية')
                        ->schema([
                            Section::make('Why Choose Us (AR)')
                                ->schema([
                                    TextInput::make('title.ar')
                                        ->label('Title (AR)')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('subtitle.ar')
                                        ->label('Subtitle (AR)')
                                        ->required()
                                        ->maxLength(255),

                                    Repeater::make('cards')
                                        ->label('Cards (AR)')
                                        ->collapsible()
                                        ->collapsed(false)
                                        ->defaultItems(1)
                                        ->itemLabel(fn(array $state) => $state['title']['ar'] ?? 'كارت جديد')
                                        ->reorderable()
                                        ->cloneable()
                                        ->schema([
                                            TextInput::make('title.ar')
                                                ->label('Card Title (AR)')
                                                ->required()
                                                ->maxLength(150),

                                            TextInput::make('subtitle.ar')
                                                ->label('Card Subtitle (AR)')
                                                ->required()
                                                ->maxLength(250),
                                        ])
                                        ->columns(1),
                                ])
                                ->columns(1),
                        ]),
                ])
                ->columnSpanFull(),
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
                    ->label('Title')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(50)
                    ->searchable(),

                BadgeColumn::make('cards')
                    ->label('Cards Count')
                    ->colors([
                        'danger'  => fn($state) => is_array($state) && count($state) < 1,
                        'warning' => fn($state) => is_array($state) && count($state) < 3,
                        'success' => fn($state) => is_array($state) && count($state) >= 3,
                    ])
                    ->formatStateUsing(fn($state) => is_array($state) ? count($state) . ' Cards' : '0'),
            ])
            ->actions([
                ViewAction::make()->label('View'),
                EditAction::make()->label('Edit'),
                DeleteAction::make()->label('Delete')->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()->label('Delete Selected'),
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
            'index'  => Pages\ListWhyChooseUs::route('/'),
            'create' => Pages\CreateWhyChooseUs::route('/create'),
            'edit'   => Pages\EditWhyChooseUs::route('/{record}/edit'),
        ];
    }
}
