<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutQualixceSectionResource\Pages;
use App\Models\AboutQualixceSection;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class AboutQualixceSectionResource extends Resource
{
    protected static ?string $model = AboutQualixceSection::class;
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'About Qualixce';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    // Title
                    TextInput::make('title')
                        ->label(__('about_qualixce.title'))
                        ->required()
                        ->maxLength(255),

                    // Subtitle
                    TextInput::make('subtitle')
                        ->label(__('about_qualixce.subtitle'))
                        ->maxLength(255),

                    // Repeater (cards)
                    Repeater::make('cards')
                        ->label(__('about_qualixce.cards'))
                        ->collapsible()
                        ->addActionLabel('Add New Card')
                        ->schema([
                            TextInput::make('order')
                                ->label('Order')
                                ->numeric()
                                ->default(0),

                            TextInput::make('icon')
                                ->label(__('about_qualixce.card_icon')),

                            TextInput::make('title')
                                ->label(__('about_qualixce.card_title'))
                                ->required()
                                ->maxLength(255),

                            Textarea::make('subtitle')
                                ->label(__('about_qualixce.card_subtitle'))
                                ->rows(3),

                            FileUpload::make('image')
                                ->label(__('about_qualixce.card_image'))
                                ->image()
                                ->directory('about-qualixce-cards')
                                ->imagePreviewHeight('150')
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                        ])
                        ->columns(1), // الكروت نفسها كمان field تحت field

                    // Main image
                    FileUpload::make('image')
                        ->label(__('about_qualixce.image'))
                        ->image()
                        ->directory('about-qualixce')
                        ->imagePreviewHeight('250')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                    // Alt text
                    TextInput::make('image_alt')
                        ->label(__('about_qualixce.image_alt'))
                        ->maxLength(255),
                ])
                ->columns(1) // كل حاجة تحت بعض
                ->columnSpanFull(),
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

            TextColumn::make('cards')
                ->label(__('about_qualixce.cards_count'))
                ->formatStateUsing(fn ($state) => is_array($state) ? count($state) : 0),

            ImageColumn::make('image')
                ->label(__('about_qualixce.image'))
                ->rounded()
                ->size(100),
        ])
        ->striped()
        ->defaultSort('title', 'asc')
        ->actions([
            \Filament\Tables\Actions\EditAction::make(),
            \Filament\Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            \Filament\Tables\Actions\DeleteBulkAction::make(),
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