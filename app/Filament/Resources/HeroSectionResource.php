<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class HeroSectionResource extends Resource
{
    use Translatable;

    protected static ?string $model = HeroSection::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?string $navigationGroup = 'Website Content';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    TextInput::make('title')
                        ->label(__('actions.hero_section_title'))
                        ->required()
                        ->maxLength(255),

                    TextInput::make('subtitle')
                        ->label(__('actions.hero_section_subtitle'))
                        ->maxLength(255),
                ])
                ->columns([
                    'default' => 1,
                    'sm' => 2,
                ])
                ->extraAttributes(['class' => 'bg-gray-50 shadow-sm border border-gray-200 rounded-lg p-6']),

            Card::make()
                ->schema([
                    FileUpload::make('background_image')
                        ->label(__('actions.hero_section_background_image'))
                        ->image()
                        ->directory('hero-sections')
                        ->required()
                        ->imagePreviewHeight('200')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                    TextInput::make('background_image_alt')
                        ->label(__('actions.hero_section_background_image_alt'))
                        ->required()
                        ->maxLength(255),
                ])
                ->columns([
                    'default' => 1,
                    'sm' => 2,
                ])
                ->extraAttributes(['class' => 'bg-gray-50 shadow-sm border border-gray-200 rounded-lg p-6']),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('actions.hero_section_title'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('subtitle')
                    ->label(__('actions.hero_section_subtitle'))
                    ->limit(50)
                    ->color('gray'),

                ImageColumn::make('background_image')
                    ->label(__('actions.hero_section_background_image'))
                    ->size(80)
                    ->circular()
                    ->defaultImageUrl(url('images/placeholder.png')),

                TextColumn::make('background_image_alt')
                    ->label(__('actions.hero_section_background_image_alt'))
                    ->limit(30)
                    ->color('gray'),
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
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}