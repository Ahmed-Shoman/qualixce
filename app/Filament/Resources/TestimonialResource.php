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
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

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

            Section::make(__('Testimonials Cards'))
                ->schema([
                    Repeater::make('cards')
                        ->label(__('Client Reviews'))
                        ->schema([
                            FileUpload::make('image')
                                ->label(__('Client Image'))
                                ->image()
                                ->directory('testimonials')
                                ->maxSize(2048)
                                ->required(),

                            Textarea::make('description')
                                ->label(__('Review Text'))
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
                ])
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

                ImageColumn::make('cards.0.image')
                    ->label(__('First Client'))
                    ->square()
                    ->height(50),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
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
