<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class HeroSectionResource extends Resource
{
    use Translatable;

    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon  = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?string $pluralLabel     = 'Hero Sections';
    protected static ?string $modelLabel      = 'Hero Section';

    public static function getNavigationGroup(): ?string
    {
        return __('المحتوى');
    }

    public static function getNavigationLabel(): string
    {
        return __('Hero Section');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Hero Sections');
    }

    public static function getModelLabel(): string
    {
        return __('Hero Section');
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make(__('النصوص'))
                ->description(__('العنوان والنص الفرعي الخاص بالـ Hero Section'))
                ->icon('heroicon-o-document-text')
                ->collapsible()
                ->schema([
                    TextInput::make('title')
                        ->label(__('Title'))
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Enter hero title')
                        ->prefixIcon('heroicon-o-sparkles')
                        ->columnSpanFull(),

                    TextInput::make('subtitle')
                        ->label(__('Subtitle'))
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Enter hero subtitle')
                        ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                        ->columnSpanFull(),
                ])
                ->columns(1),

            Section::make(__('الخلفية'))
                ->description(__('اختر صورة أو فيديو ليظهر كخلفية للـ Hero Section'))
                ->icon('heroicon-o-photo')
                ->collapsible()
                ->schema([
                    FileUpload::make('background_media')
                        ->label(__('Background (Image or Video)'))
                        ->directory('hero-sections')
                        ->required()
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->imagePreviewHeight('250')
                        ->acceptedFileTypes([
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            'video/mp4',
                            'video/webm',
                            'video/ogg',
                        ])
                        ->maxSize(20480)
                        ->downloadable()
                        ->openable()
                        ->previewable(true)
                        ->columnSpanFull()
                        ->helperText('Max size: 20MB. Supported: Images (JPEG, PNG, WebP) or Videos (MP4, WebM, OGG)'),

                    TextInput::make('background_media_alt')
                        ->label(__('Background Alt Text'))
                        ->maxLength(255)
                        ->placeholder('Describe the background media')
                        ->prefixIcon('heroicon-o-information-circle')
                        ->columnSpanFull(),
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
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->size('sm')
                    ->icon('heroicon-o-sparkles')
                    ->iconColor('primary')
                    ->copyable()
                    ->copyMessage('Title copied!')
                    ->copyMessageDuration(1500)
                    ->wrap(),

                TextColumn::make('subtitle')
                    ->label(__('Subtitle'))
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->subtitle)
                    ->color('gray')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->wrap(),

                TextColumn::make('background_media')
                    ->label(__('Media'))
                    ->badge()
                    ->formatStateUsing(fn ($state) =>
                        $state && Str::endsWith($state, ['.mp4', '.webm', '.ogg'])
                            ? 'Video'
                            : 'Image'
                    )
                    ->color(fn ($state) =>
                        $state && Str::endsWith($state, ['.mp4', '.webm', '.ogg'])
                            ? 'success'
                            : 'info'
                    )
                    ->icon(fn ($state) =>
                        $state && Str::endsWith($state, ['.mp4', '.webm', '.ogg'])
                            ? 'heroicon-o-video-camera'
                            : 'heroicon-o-photo'
                    )
                    ->url(fn ($state) => $state ? url('storage/' . $state) : null)
                    ->openUrlInNewTab()
                    ->sortable(),

                TextColumn::make('background_media_alt')
                    ->label(__('Alt Text'))
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->background_media_alt)
                    ->color('gray'),
            ])
            ->defaultSort('title', 'asc')
            ->striped()
            ->actions([
                \Filament\Tables\Actions\ViewAction::make()->label(__('عرض')),
                \Filament\Tables\Actions\EditAction::make()->label(__('تعديل')),
                \Filament\Tables\Actions\DeleteAction::make()->label(__('حذف')),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\DeleteBulkAction::make()->label(__('حذف المحدد')),
            ]);
    }

    /**
     * ---------- Pages ----------
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit'   => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}