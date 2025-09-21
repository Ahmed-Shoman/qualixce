<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms\Form;
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
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Hero Sections';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('actions.hero_section_title'))
                    ->required(),

                TextInput::make('subtitle')
                    ->label(__('actions.hero_section_subtitle')),

                FileUpload::make('background_image')
                    ->label(__('actions.hero_section_background_image'))
                    ->image(),

                TextInput::make('background_image_alt')
                    ->label(__('actions.hero_section_background_image_alt'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('actions.hero_section_title')),
                TextColumn::make('subtitle')->label(__('actions.hero_section_subtitle')),
                ImageColumn::make('background_image')->label(__('actions.hero_section_background_image')),
                TextColumn::make('background_image_alt')->label(__('actions.hero_section_background_image_alt')),
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