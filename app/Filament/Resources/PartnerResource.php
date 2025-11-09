<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Partners';
    protected static ?string $pluralLabel = 'Partners';
    protected static ?string $modelLabel = 'Partner';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    public static function form(Form $form): Form
    {
        $locales = self::getTranslatableLocales();

        return $form->schema([
            // Section 1: Texts
            Section::make(__('Partner Texts'))
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
                ])
                ->columns(1),

            Section::make(__('Partner Logos'))
                ->schema([
                    Repeater::make('images')
                        ->label(__('Partner Logos'))
                        ->schema([
                            FileUpload::make('image')
                                ->label(__('Image'))
                                ->image()
                                ->directory('partners')
                                ->maxSize(2048)
                                ->required(),

                            TextInput::make('url')
                                ->label(__('URL'))
                                ->url()
                                ->placeholder('https://example.com'),
                        ])
                        ->columns(1)
                        ->reorderable()
                        ->minItems(1)
                        ->collapsed(false),
                ])
                ->columns(1),

            Section::make(__('Visibility'))
                ->schema([
                    Toggle::make('is_active')
                        ->label(__('Visible on website'))
                        ->default(true),
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

                ImageColumn::make('images.0.image')
                    ->label(__('First Logo'))
                    ->square()
                    ->height(50),

                // TextColumn::make('images.0.url')
                //     ->label(__('First URL'))
                //     ->formatStateUsing(fn($record) => data_get($record, 'images.0.url') ?? '-')
                //     ->url(fn($record) => data_get($record, 'images.0.url')),

                IconColumn::make('is_active')
                    ->label(__('Visible'))
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
