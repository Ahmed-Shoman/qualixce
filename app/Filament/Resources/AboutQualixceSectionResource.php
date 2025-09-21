<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutQualixceSectionResource\Pages;
use App\Models\AboutQualixceSection;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Card;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class AboutQualixceSectionResource extends Resource
{
    protected static ?string $model = AboutQualixceSection::class;
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'About Qualixce';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Big card wrapping everything
            Card::make([
                // Title & Subtitle
                TextInput::make('title')
                    ->label(__('about_qualixce.title'))
                    ->required(),

                TextInput::make('subtitle')
                    ->label(__('about_qualixce.subtitle')),

                // Repeater for cards
                Repeater::make('cards')
                    ->label(__('about_qualixce.cards'))
                    ->collapsible()
                    ->schema([
                        TextInput::make('order')
                            ->label('Order')
                            ->numeric()
                            ->default(0),

                        TextInput::make('icon')
                            ->label(__('about_qualixce.card_icon')),

                        TextInput::make('title')
                            ->label(__('about_qualixce.card_title'))
                            ->required(),

                        Textarea::make('subtitle')
                            ->label(__('about_qualixce.card_subtitle'))
                            ->rows(2),

                        FileUpload::make('image')
                            ->label(__('about_qualixce.card_image'))
                            ->image()
                            ->imagePreviewHeight('80'),
                    ]),

                // Main Image & Alt
                FileUpload::make('image')
                    ->label(__('about_qualixce.image'))
                    ->image()
                    ->imagePreviewHeight('150'),

                TextInput::make('image_alt')
                    ->label(__('about_qualixce.image_alt'))
                    ->maxLength(255),
            ])->columnSpanFull(), // Big card takes full width
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->label(__('about_qualixce.title'))
                ->searchable()
                ->sortable(),

            TextColumn::make('subtitle')
                ->label(__('about_qualixce.subtitle'))
                ->limit(50),

            TextColumn::make('cards_count')
                ->label(__('about_qualixce.cards_count'))
                ->counts('cards'),

            ImageColumn::make('image')
                ->label(__('about_qualixce.image'))
                ->rounded(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutQualixceSections::route('/'),
            'create' => Pages\CreateAboutQualixceSection::route('/create'),
            'edit' => Pages\EditAboutQualixceSection::route('/{record}/edit'),
        ];
    }
}
