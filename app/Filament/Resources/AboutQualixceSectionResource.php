<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutQualixceSectionResource\Pages;
use App\Models\AboutQualixceSection;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
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

    protected static ?string $navigationIcon  = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'About Qualixce';
    protected static ?string $pluralLabel     = 'About Qualixce Sections';
    protected static ?string $modelLabel      = 'About Qualixce Section';

    public static function getNavigationGroup(): ?string
    {
        return __('المحتوى');
    }

    public static function getNavigationLabel(): string
    {
        return __('About Qualixce');
    }

    public static function getPluralLabel(): ?string
    {
        return __('About Qualixce Sections');
    }

    public static function getModelLabel(): string
    {
        return __('About Qualixce Section');
    }

    /**
     * --------- Form ---------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make(__('البيانات الأساسية'))
                ->description(__('أدخل البيانات الأساسية للقسم'))
                ->icon('heroicon-o-information-circle')
                ->collapsible()
                ->schema([
                    TextInput::make('title')
                        ->label(__('العنوان'))
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-document-text')
                        ->placeholder('Enter section title'),

                    TextInput::make('subtitle')
                        ->label(__('العنوان الفرعي'))
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-chat-bubble-left-right')
                        ->placeholder('Enter section subtitle'),
                ])
                ->columns(2),

            Section::make(__('الكروت'))
                ->description(__('إضافة كروت مرتبطة بهذا القسم'))
                ->icon('heroicon-o-squares-2x2')
                ->collapsible()
                ->schema([
                    Repeater::make('cards')
                        ->label(__('الكروت'))
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel(__('➥ إضافة كارت جديد'))
                        ->reorderable()
                        ->reorderableWithButtons()
                        ->cloneable()
                        ->schema([
                            TextInput::make('order')
                                ->label(__('الترتيب'))
                                ->numeric()
                                ->default(0),

                            TextInput::make('icon')
                                ->label(__('الأيقونة'))
                                ->placeholder('مثال: heroicon-o-star'),

                            TextInput::make('title')
                                ->label(__('عنوان الكارت'))
                                ->required()
                                ->maxLength(255),

                            Textarea::make('subtitle')
                                ->label(__('الوصف'))
                                ->rows(3),

                            FileUpload::make('image')
                                ->label(__('صورة الكارت'))
                                ->image()
                                ->directory('about-qualixce-cards')
                                ->imagePreviewHeight('150')
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                        ])
                        ->columns(2),
                ]),

            Section::make(__('الصورة الرئيسية'))
                ->description(__('قم برفع الصورة الرئيسية لهذا القسم'))
                ->icon('heroicon-o-photo')
                ->collapsible()
                ->schema([
                    FileUpload::make('image')
                        ->label(__('الصورة الرئيسية'))
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                        ->directory('about-qualixce')
                        ->imagePreviewHeight('250')
                        ->downloadable()
                        ->openable()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Recommended size: 1200x800px'),

                    TextInput::make('image_alt')
                        ->label(__('النص البديل للصورة'))
                        ->maxLength(255),
                ])
                ->columns(2),
        ]);
    }

    /**
     * --------- Table ---------
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('العنوان'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('subtitle')
                    ->label(__('العنوان الفرعي'))
                    ->limit(40),

                TextColumn::make('cards')
                    ->label(__('عدد الكروت'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) : 0),

                ImageColumn::make('image')
                    ->label(__('الصورة الرئيسية'))
                    ->circular()
                    ->size(60),
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
     * --------- Pages ---------
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAboutQualixceSections::route('/'),
            'create' => Pages\CreateAboutQualixceSection::route('/create'),
            'edit'   => Pages\EditAboutQualixceSection::route('/{record}/edit'),
        ];
    }
}