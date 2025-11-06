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
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

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
            // section 1 => titles (translatable)
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

            // section 2 => images (not translatable)
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
                        ])
                        ->columns(1)
                        ->reorderable()
                        ->minItems(1)
                        ->collapsed(false),
                ])
                ->columns(1),
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