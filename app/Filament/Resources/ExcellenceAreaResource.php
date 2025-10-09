<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExcellenceAreaResource\Pages;
use App\Models\ExcellenceArea;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ExcellenceAreaResource extends Resource
{
    protected static ?string $model = ExcellenceArea::class;

    protected static ?string $navigationIcon  = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Excellence Areas';
    protected static ?string $pluralLabel     = 'Excellence Areas';
    protected static ?string $modelLabel      = 'Excellence Area';

    public static function getNavigationGroup(): ?string
    {
        return __('المحتوى');
    }

    public static function getNavigationLabel(): string
    {
        return __('Excellence Areas');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Excellence Areas');
    }

    public static function getModelLabel(): string
    {
        return __('Excellence Area');
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make(__('البيانات الأساسية'))
                ->description(__('أدخل العنوان الرئيسي والفرعي لمنطقة التميز'))
                ->icon('heroicon-o-academic-cap')
                ->collapsible()
                ->schema([
                    TextInput::make('title')
                        ->label(__('Title'))
                        ->required()
                        ->maxLength(255),

                    TextInput::make('subtitle')
                        ->label(__('Subtitle'))
                        ->required()
                        ->maxLength(255),
                ])
                ->columns(2),

            Section::make(__('الكروت'))
                ->description(__('أضف الكروت المرتبطة بمنطقة التميز'))
                ->icon('heroicon-o-rectangle-stack')
                ->collapsible()
                ->schema([
                    Repeater::make('cards')
                        ->label(__('Cards'))
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel(__('➕ إضافة كارت'))
                        ->reorderable()
                        ->cloneable()
                        ->schema([
                            TextInput::make('title')
                                ->label(__('Card Title'))
                                ->required()
                                ->maxLength(255),

                            TextInput::make('subtitle')
                                ->label(__('Card Subtitle'))
                                ->required()
                                ->maxLength(255),

                            Textarea::make('description')
                                ->label(__('Description'))
                                ->rows(3)
                                ->required(),

                            Repeater::make('points')
                                ->label(__('النقاط'))
                                ->addActionLabel(__('➕ إضافة نقطة'))
                                ->schema([
                                    TextInput::make('point')
                                        ->label(__('Point'))
                                        ->required(),
                                ])
                                ->columns(1)
                                ->columnSpanFull(),
                        ])
                        ->columns(2),
                ]),
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

                TextColumn::make('subtitle')
                    ->label(__('Subtitle'))
                    ->limit(50),

                TextColumn::make('cards')
                    ->label(__('عدد الكروت'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) : 0),
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
            'index'  => Pages\ListExcellenceAreas::route('/'),
            'create' => Pages\CreateExcellenceArea::route('/create'),
            'edit'   => Pages\EditExcellenceArea::route('/{record}/edit'),
        ];
    }
}