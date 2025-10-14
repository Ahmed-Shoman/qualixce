<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutQualixceSectionResource\Pages;
use App\Models\AboutQualixceSection;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class AboutQualixceSectionResource extends Resource
{
    protected static ?string $model = AboutQualixceSection::class;
    protected static ?string $navigationIcon  = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'About Qualixce';
    protected static ?string $pluralLabel     = 'About Qualixce Sections';
    protected static ?string $modelLabel      = 'About Qualixce Section';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([

            Tabs::make('Translations')
                ->tabs([
                    // EN Tab
                    Tab::make('English')->schema([
                        Section::make('Basic Info (EN)')->schema([
                            TextInput::make('title.en')->label('Title (EN)')->required(),
                            TextInput::make('subtitle.en')->label('Subtitle (EN)')->required(),
                        ]),
                        Section::make('Cards (EN)')->schema([
                            Repeater::make('cards')
                                ->label('Cards')
                                ->collapsed(false)
                                ->defaultItems(1)
                                ->itemLabel(fn(array $state) => $state['title']['en'] ?? 'Card')
                                ->addActionLabel('➥ Add Card')
                                ->reorderable()
                                ->cloneable()
                                ->schema([
                                    TextInput::make('title.en')->label('Card Title (EN)')->required(),
                                    Textarea::make('subtitle.en')->label('Card Subtitle (EN)')->rows(2)->required(),
                                ]),
                        ]),
                    ]),

                    // AR Tab
                    Tab::make('العربية')->schema([
                        Section::make('البيانات الأساسية (AR)')->schema([
                            TextInput::make('title.ar')->label('العنوان (AR)')->required(),
                            TextInput::make('subtitle.ar')->label('العنوان الفرعي (AR)')->required(),
                        ]),
                        Section::make('الكروت (AR)')->schema([
                            Repeater::make('cards')
                                ->label('الكروت')
                                ->collapsed(false)
                                ->defaultItems(1)
                                ->itemLabel(fn(array $state) => $state['title']['ar'] ?? 'كارت جديد')
                                ->addActionLabel('➥ إضافة كارت')
                                ->reorderable()
                                ->cloneable()
                                ->schema([
                                    TextInput::make('title.ar')->label('عنوان الكارت (AR)')->required(),
                                    Textarea::make('subtitle.ar')->label('الوصف (AR)')->rows(2)->required(),

                                ]),
                        ]),
                    ]),
                ])
                ->columnSpanFull(),

            Section::make('Main Image')->schema([
                FileUpload::make('image')->label('Main Image')->image()->directory('about-qualixce')->required(),
                Tabs::make('Image Alt Text')->tabs([
                    Tab::make('English')->schema([
                        TextInput::make('image_alt.en')->label('Alt Text (EN)')->required(),
                    ]),
                    Tab::make('العربية')->schema([
                        TextInput::make('image_alt.ar')->label('النص البديل (AR)')->required(),
                    ]),
                ]),
            ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cards')->label('Cards Count')->badge()->formatStateUsing(fn($state) => is_array($state) ? count($state) : 0),
                ImageColumn::make('image')->label('Main Image')->size(70)->circular(),
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()->label(__('Edit')),
                Tables\Actions\DeleteAction::make()->label(__('Delete')),
                Tables\Actions\ViewAction::make()->label(__('View')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label(__('Delete Selected')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAboutQualixceSections::route('/'),
            'create' => Pages\CreateAboutQualixceSection::route('/create'),
            'edit'   => Pages\EditAboutQualixceSection::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return AboutQualixceSection::count() === 0;
    }
}
