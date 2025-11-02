<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon  = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Settings';
    protected static ?string $pluralLabel     = 'Settings';
    protected static ?string $modelLabel      = 'Setting';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Tabs::make('Settings Tabs')
                ->tabs([
                    Tab::make('General')->schema([
                        Section::make('Basic Setting Info')->schema([
                            // ✅ هنا التعديل — key بقت Select بدل TextInput
                            Select::make('key')
                                ->label('Section')
                                ->required()
                                ->options([
                                    'about_qualixce'        => 'About Qualixce',
                                    'excellence_areas'      => 'Excellence Areas',
                                    'founder_message'       => 'Founder Message',
                                    'hero_section'          => 'Hero Section',
                                    'our_services'          => 'Our Services',
                                    'our_values'            => 'Our Values',
                                    'proven_processes'      => 'Proven Processes',
                                    'why_choose_us'         => 'Why Choose Us',
                                    'website_requests'      => 'Website Requests',
                                    'consultation_requests' => 'Consultation Requests',
                                ])
                                ->helperText('اختر السكشن الذي تريد تعديل إعداداته')
                                ->unique(ignoreRecord: true)
                                ->reactive(),

                            Select::make('type')
                                ->label('Setting Type')
                                ->options([
                                    'color' => 'Color',
                                    'font'  => 'Font Family',
                                    'text'  => 'Text',
                                ])
                                ->required()
                                ->reactive(),

                            // اللون
                            ColorPicker::make('value')
                                ->label('Color Value')
                                ->visible(fn ($get) => $get('type') === 'color'),

                            // الخط
                            Select::make('value')
                                ->label('Font Family')
                                ->options([
                                    'Cairo' => 'Cairo',
                                    'Roboto' => 'Roboto',
                                    'Poppins' => 'Poppins',
                                    'Montserrat' => 'Montserrat',
                                    'Open Sans' => 'Open Sans',
                                ])
                                ->visible(fn ($get) => $get('type') === 'font'),

                            // النصوص
                            Textarea::make('value')
                                ->label('Text Value')
                                ->visible(fn ($get) => $get('type') === 'text'),
                        ]),
                    ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('Section')->searchable(),
                TextColumn::make('type')->label('Type'),
                TextColumn::make('value')->label('Value')->limit(30),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d M Y - H:i'),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()->label(__('Edit')),
                Tables\Actions\DeleteAction::make()->label(__('Delete')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label(__('Delete Selected')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit'   => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}