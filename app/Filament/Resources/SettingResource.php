<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Settings';
    protected static ?string $pluralLabel = 'Settings';
    protected static ?string $modelLabel = 'Setting';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Light Mode Colors')
                ->description('Customize the primary and secondary colors for light mode.')
                ->schema([
                    ColorPicker::make('primary_color_light')
                        ->label('Primary Color (Light)')
                        ->required(),
                    ColorPicker::make('secondary_color_light')
                        ->label('Secondary Color (Light)')
                        ->required(),
                ])
                ->columns(2),

            Section::make('Dark Mode Colors')
                ->description('Customize the primary and secondary colors for dark mode.')
                ->schema([
                    ColorPicker::make('primary_color_dark')
                        ->label('Primary Color (Dark)')
                        ->required(),
                    ColorPicker::make('secondary_color_dark')
                        ->label('Secondary Color (Dark)')
                        ->required(),
                ])
                ->columns(2),

            Section::make('Font Settings')
                ->description('Select the default fonts for Arabic and English with their fallbacks.')
                ->schema([

                    Select::make('font_family_ar')
                        ->label('Arabic Font')
                        ->options([
                            'Cairo, sans-serif' => 'Cairo (Fallback: sans-serif)',
                            'Tajawal, sans-serif' => 'Tajawal (Fallback: sans-serif)',
                            'Amiri, serif' => 'Amiri (Fallback: serif)',
                            'Noto Kufi Arabic, sans-serif' => 'Noto Kufi Arabic (Fallback: sans-serif)',
                            'Changa, sans-serif' => 'Changa (Fallback: sans-serif)',
                        ])
                        ->required()
                        ->searchable()
                        ->hint('Used for Arabic text elements.'),

                    Select::make('font_family_en')
                        ->label('English Font')
                        ->options([
                            'Roboto, sans-serif' => 'Roboto (Fallback: sans-serif)',
                            'Poppins, sans-serif' => 'Poppins (Fallback: sans-serif)',
                            'Montserrat, sans-serif' => 'Montserrat (Fallback: sans-serif)',
                            'Open Sans, sans-serif' => 'Open Sans (Fallback: sans-serif)',
                            'Lato, sans-serif' => 'Lato (Fallback: sans-serif)',
                        ])
                        ->required()
                        ->searchable()
                        ->hint('Used for English text elements.'),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ColorColumn::make('primary_color_light')->label('Primary (Light)'),
            ColorColumn::make('secondary_color_light')->label('Secondary (Light)'),
            ColorColumn::make('primary_color_dark')->label('Primary (Dark)'),
            ColorColumn::make('secondary_color_dark')->label('Secondary (Dark)'),
            TextColumn::make('font_family_ar')->label('Arabic Font')->limit(30),
            TextColumn::make('font_family_en')->label('English Font')->limit(30),
            TextColumn::make('updated_at')
                ->label('Updated')
                ->dateTime('d M Y - H:i'),
        ])
        ->defaultSort('updated_at', 'desc')
        ->actions([
            Tables\Actions\EditAction::make()->label('Edit'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\EditSetting::route('/'),
        ];
    }
}
