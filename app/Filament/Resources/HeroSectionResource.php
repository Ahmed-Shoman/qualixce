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
use Illuminate\Support\Str;

class HeroSectionResource extends Resource
{
    use Translatable;

    protected static ?string $model = HeroSection::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Hero Section';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    TextInput::make('title')
                        ->label('Title')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('subtitle')
                        ->label('Subtitle')
                        ->required()
                        ->maxLength(255),
                ])
                ->columns(1)                 ->extraAttributes(['class' => 'bg-white shadow border border-gray-200 rounded-xl p-6']),

            Card::make()
                ->schema([
                    FileUpload::make('background_media')
                        ->label('Background (Image or Video)')
                        ->directory('hero-sections')
                        ->required()
                        ->imagePreviewHeight('200')
                        ->acceptedFileTypes([
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            'video/mp4',
                            'video/webm',
                            'video/ogg',
                        ])
                        ->maxSize(20480) // 20MB
                        ->previewable(true),

                    TextInput::make('background_media_alt')
                        ->label('Background Alt Text')
                        ->maxLength(255)
                ])
                ->columns(1) // << هنا كمان الحقول فوق بعض
                ->extraAttributes(['class' => 'bg-white shadow border border-gray-200 rounded-xl p-6']),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->subtitle)
                    ->color('gray'),

                TextColumn::make('background_media')
                    ->label('Media')
                    ->formatStateUsing(fn ($state) =>
                        $state && Str::endsWith($state, ['.mp4', '.webm', '.ogg'])
                            ? '🎥 Video'
                            : '🖼️ Image'
                    )
                    ->url(fn ($state) => $state ? url('storage/' . $state) : null)
                    ->openUrlInNewTab()
                    ->icon(fn ($state) =>
                        $state && Str::endsWith($state, ['.mp4', '.webm', '.ogg'])
                            ? 'heroicon-o-video-camera'
                            : 'heroicon-o-photo'
                    )
                    ->sortable(),

                TextColumn::make('background_media_alt')
                    ->label('Alt Text')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->background_media_alt)
                    ->color('gray'),
            ])
            ->striped()
            ->defaultSort('title', 'asc')
            ->filters([])
            ->actions([
                \Filament\Tables\Actions\ViewAction::make(),
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
