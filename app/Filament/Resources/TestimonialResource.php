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
    protected static ?string $pluralLabel = 'Testimonials';
    protected static ?string $modelLabel = 'Testimonial';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    public static function form(Form $form): Form
    {
        $locales = self::getTranslatableLocales();

        return $form->schema([

            // 🟩 Section 1: Titles
            Section::make(__('Texts'))
                ->description(__('Add section title & subtitle'))
                ->schema([
                    Tabs::make('Translations')
                        ->tabs(array_map(function ($locale) {
                            return Tabs\Tab::make(strtoupper($locale))
                                ->schema([
                                    TextInput::make("title.$locale")
                                        ->label(__('Title') . " ($locale)")
                                        ->required(),
                                    TextInput::make("subtitle.$locale")
                                        ->label(__('Subtitle') . " ($locale)")
                                        ->nullable(),
                                ]);
                        }, $locales)),
                ]),

            // 🟩 Section 2: Client Info
            Section::make(__('Client Info'))
                ->description(__('Add client name and role'))
                ->schema([
                    Tabs::make('Client Translations')
                        ->tabs(array_map(function ($locale) {
                            return Tabs\Tab::make(strtoupper($locale))
                                ->schema([
                                    TextInput::make("client_name.$locale")
                                        ->label(__('Client Name') . " ($locale)")
                                        ->required(),

                                    TextInput::make("client_role.$locale")
                                        ->label(__('Client Role / Position') . " ($locale)")
                                        ->nullable(),
                                ]);
                        }, $locales)),
                ]),

            // 🟩 Section 3: Testimonial Cards
            Section::make(__('Testimonials Cards'))
                ->schema([
                    Repeater::make('cards')
                        ->label(__('Client Reviews'))
                        ->schema([
                            FileUpload::make('image_url')
                                ->label(__('Client Image'))
                                ->image()
                                ->directory('testimonials')
                                ->maxSize(2048)
                                ->required(),

                            Textarea::make('description')
                                ->label(__('Review Text'))
                                ->rows(3)
                                ->required(),

                            TextInput::make('stars')
                                ->label(__('Stars (1-5)'))
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

            // 🟩 Section 4: Visibility Toggle
            Section::make(__('Visibility'))
                ->description(__('Control whether this section is visible on the website'))
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
                    ->sortable(),

                TextColumn::make('client_name')
                    ->label(__('Client (EN)'))
                    ->formatStateUsing(fn($record) => $record->getTranslation('client_name', 'en'))
                    ->sortable(),

                ImageColumn::make('cards.0.image_url')
                    ->label(__('First Client Image'))
                    ->square()
                    ->height(50),

                IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean()
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
