<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?string $pluralLabel = 'Hero Sections';
    protected static ?string $modelLabel = 'Hero Section';

    /**
     * Define which locales your fields can be translated to.
     */
    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make(__('Texts'))
                ->description(__('Main title and subtitle for the Hero Section'))
                ->icon('heroicon-o-document-text')
                ->collapsible()
                ->schema([

                    Tabs::make('Translations')
                        ->tabs([
                            Tabs\Tab::make('English')->schema([
                                TextInput::make('title.en')
                                    ->label(__('Title (EN)'))
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                TextInput::make('subtitle.en')
                                    ->label(__('Subtitle (EN)'))
                                    ->maxLength(255)
                                    ->required()
                                    ->columnSpanFull(),

                                TextInput::make('background_image_alt.en')
                                    ->label(__('Image Alt (EN)'))
                                    ->maxLength(255)
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                            Tabs\Tab::make('Arabic')->schema([
                                TextInput::make('title.ar')
                                    ->label(__('Title (AR)'))
                                    ->required()
                                    ->maxLength(255)
                                    ->extraAttributes(['dir' => 'rtl'])
                                    ->columnSpanFull(),

                                TextInput::make('subtitle.ar')
                                    ->label(__('Subtitle (AR)'))
                                    ->maxLength(255)
                                    ->required()
                                    ->extraAttributes(['dir' => 'rtl'])
                                    ->columnSpanFull(),

                                TextInput::make('background_image_alt.ar')
                                    ->label(__('Image Alt (AR)'))
                                    ->maxLength(255)
                                    ->required()
                                    ->extraAttributes(['dir' => 'rtl'])
                                    ->columnSpanFull(),
                            ]),
                        ]),
                ])
                ->columns(1),

            Section::make(__('Background'))
                ->description(__('Choose an image or video as background for the Hero Section'))
                ->icon('heroicon-o-photo')
                ->collapsible()
                ->schema([

                    FileUpload::make('background_image')
                        ->label(__('Background (Image or Video)'))
                        ->directory('hero-sections')
                        ->required()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                        ->imagePreviewHeight('250')
                        ->acceptedFileTypes([
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            'video/mp4',
                            'video/webm',
                            'video/ogg',
                        ])
                        ->maxSize(20480) // 20MB
                        ->downloadable()
                        ->openable()
                        ->previewable(true)
                        ->columnSpanFull()
                        ->helperText('Max size: 20MB. Supported: Images (JPEG, PNG, WebP) or Videos (MP4, WebM, OGG)'),
                ])
                ->columns(1),
        ]);
    }

    /**
     * ---------- Table ----------
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title (EN)'))
                    ->formatStateUsing(fn($record) => $record->getTranslation('title', 'en'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->size('sm')
                    ->wrap(),

                TextColumn::make('title')
                    ->label(__('Title '))
                    ->formatStateUsing(fn($record) => $record->getTranslation('title', 'ar'))
                    ->color('gray')
                    ->wrap(),

                TextColumn::make('background_image')
                    ->label(__('Background'))
                    ->badge()
                    ->formatStateUsing(
                        fn($state) =>
                        $state && Str::endsWith($state, ['.mp4', '.webm', '.ogg'])
                            ? 'Video'
                            : 'Image'
                    )
                    ->color(
                        fn($state) =>
                        $state && Str::endsWith($state, ['.mp4', '.webm', '.ogg'])
                            ? 'success'
                            : 'info'
                    )
                    ->icon(
                        fn($state) =>
                        $state && Str::endsWith($state, ['.mp4', '.webm', '.ogg'])
                            ? 'heroicon-o-video-camera'
                            : 'heroicon-o-photo'
                    )
                    ->url(fn($state) => $state ? url('storage/' . $state) : null)
                    ->openUrlInNewTab()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->striped()
            ->actions([
                \Filament\Tables\Actions\EditAction::make()->label(__('Edit')),
                \Filament\Tables\Actions\DeleteAction::make()->label(__('Delete')),
                \Filament\Tables\Actions\ViewAction::make()->label(__('View')),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\DeleteBulkAction::make()->label(__('Delete Selected')),
            ]);
    }


    /**
     * ---------- Pages ----------
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }

    /**
     * Restrict creation to a single hero section.
     */
    public static function canCreate(): bool
    {
        return HeroSection::count() === 0;
    }
}
