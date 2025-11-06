<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationLabel = 'Testimonials';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    public static function form(Form $form): Form
    {
        $locales = self::getTranslatableLocales();

        return $form->schema([

            // Section 1: Titles
            Section::make(__('Section Titles'))
                ->description(__('Add title & subtitle'))
                ->schema([
                    Tabs::make('Translations')
                        ->tabs(array_map(fn($locale) => Tabs\Tab::make(strtoupper($locale))
                            ->schema([
                                TextInput::make("title.$locale")
                                    ->label(__('Title') . " ($locale)")
                                    ->required(),
                                TextInput::make("subtitle.$locale")
                                    ->label(__('Subtitle') . " ($locale)")
                                    ->nullable(),
                            ]), $locales)),
                ]),

            // Section 2: Clients Repeater
            Section::make(__('Client Testimonials'))
                ->description(__('Add clients reviews with details'))
                ->schema([
                    Repeater::make('clients')
                        ->label(__('Clients'))
                        ->schema([
                            FileUpload::make('image')
                                ->label(__('Client Image'))
                                ->image()
                                ->directory('testimonials')
                                ->maxSize(2048)
                                ->required(),

                            Tabs::make('Client Translations')
                                ->tabs(array_map(fn($locale) => Tabs\Tab::make(strtoupper($locale))
                                    ->schema([
                                        TextInput::make("client_name.$locale")
                                            ->label(__('Client Name') . " ($locale)")
                                            ->required(),
                                        TextInput::make("client_role.$locale")
                                            ->label(__('Client Role / Position') . " ($locale)")
                                            ->nullable(),
                                        Textarea::make("review_text.$locale")
                                            ->label(__('Review Text') . " ($locale)")
                                            ->rows(3)
                                            ->required(),
                                    ]), $locales)),

                            TextInput::make('stars')
                                ->label(__('Stars (1–5)'))
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(5)
                                ->default(5)
                                ->required(),
                        ])
                        ->columns(1)
                        ->reorderable()
                        ->minItems(1),
                ]),

            // Section 3: Visibility
            Section::make(__('Visibility'))
                ->schema([
                    Toggle::make('is_active')
                        ->label(__('Show on Website'))
                        ->default(true)
                        ->onColor('success')
                        ->offColor('danger'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title (EN)'))
                    ->formatStateUsing(fn($record) => $record->getTranslation('title', 'en'))
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                ImageColumn::make('clients.0.image')
                    ->label(__('First Client Image'))
                    ->square()
                    ->height(50),

                TextColumn::make('clients.0.client_name.en')
                    ->label(__('First Client Name'))
                    ->formatStateUsing(fn($record) =>
                        data_get($record, 'clients.0.client_name.en') ?? '-'
                    )
                    ->limit(25)
                    ->sortable(),

                TextColumn::make('clients.0.client_role.en')
                    ->label(__('Client Role'))
                    ->formatStateUsing(fn($record) =>
                        data_get($record, 'clients.0.client_role.en') ?? '-'
                    )
                    ->limit(25),

                TextColumn::make('clients.0.stars')
                    ->label(__('Stars ⭐'))
                    ->formatStateUsing(fn($record) =>
                        str_repeat('⭐', (int) data_get($record, 'clients.0.stars', 0))
                    )
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean()
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}