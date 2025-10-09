<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FounderMessageResource\Pages;
use App\Models\FounderMessage;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class FounderMessageResource extends Resource
{
    protected static ?string $model = FounderMessage::class;

    protected static ?string $navigationIcon  = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Founder Message';
    protected static ?string $pluralLabel     = 'Founder Messages';
    protected static ?string $modelLabel      = 'Founder Message';

    public static function getNavigationGroup(): ?string
    {
        return __('المحتوى');
    }

    public static function getNavigationLabel(): string
    {
        return __('Founder Message');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Founder Messages');
    }

    public static function getModelLabel(): string
    {
        return __('Founder Message');
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make(__('البيانات الأساسية'))
                ->description(__('أدخل العنوان والوصف الخاص برسالة المؤسس'))
                ->icon('heroicon-o-document-text')
                ->collapsible()
                ->schema([
                    TextInput::make('title')
                        ->label(__('Title'))
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label(__('Description'))
                        ->rows(5)
                        ->required(),
                ])
                ->columns(1),

            Section::make(__('بيانات المؤسس'))
                ->description(__('أدخل بيانات الشخص صاحب الرسالة'))
                ->icon('heroicon-o-user-circle')
                ->collapsible()
                ->schema([
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-user'),

                    TextInput::make('position')
                        ->label(__('Position'))
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-briefcase'),

                    FileUpload::make('image')
                        ->label(__('Founder Image'))
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['1:1', '4:3'])
                        ->directory('founder-messages')
                        ->imagePreviewHeight('200')
                        ->avatar()
                        ->downloadable()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->columnSpanFull()
                        ->helperText('Upload a professional photo'),
                ])
                ->columns(2),
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
                    ->limit(50),

                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),

                TextColumn::make('position')
                    ->label(__('Position'))
                    ->sortable(),

                ImageColumn::make('image')
                    ->label(__('Image'))
                    ->rounded()
                    ->size(80),
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
            'index'  => Pages\ListFounderMessages::route('/'),
            'create' => Pages\CreateFounderMessage::route('/create'),
            'edit'   => Pages\EditFounderMessage::route('/{record}/edit'),
        ];
    }
}