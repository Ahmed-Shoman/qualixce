<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhyChooseUsResource\Pages;
use App\Models\WhyChooseUs;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class WhyChooseUsResource extends Resource
{
    protected static ?string $model = WhyChooseUs::class;

    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Why Choose Us';

    public static function getNavigationGroup(): ?string
    {
        return __('محتوى الموقع');
    }

    public static function getNavigationLabel(): string
    {
        return __('Why Choose Us');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Why Choose Us');
    }

    public static function getModelLabel(): string
    {
        return __('Why Choose Us');
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('Why Choose Us Info'))
                ->description(__('إضافة/تعديل بيانات Why Choose Us'))
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

            Section::make(__('Cards'))
                ->description(__('إضافة الكروت الخاصة بالقسم'))
                ->schema([
                    Repeater::make('cards')
                        ->label(__('Cards'))
                        ->collapsible()
                        ->schema([
                            TextInput::make('icon')
                                ->label(__('Icon'))
                                ->maxLength(100),

                            TextInput::make('title')
                                ->label(__('Card Title'))
                                ->required()
                                ->maxLength(150),

                            TextInput::make('subtitle')
                                ->label(__('Card Subtitle'))
                                ->required()
                                ->maxLength(250),
                        ])
                        ->columns(3),
                ])
                ->collapsed(false),
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
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subtitle')
                    ->label(__('Subtitle'))
                    ->limit(50)
                    ->searchable(),

                BadgeColumn::make('cards')
                    ->label(__('Cards Count'))
                    ->colors([
                        'danger'  => fn ($state) => is_array($state) && count($state) < 1,
                        'warning' => fn ($state) => is_array($state) && count($state) < 3,
                        'success' => fn ($state) => is_array($state) && count($state) >= 3,
                    ])
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' Cards' : '0'),
            ])
            ->actions([
                EditAction::make()->label(__('تعديل')),
                DeleteAction::make()->label(__('حذف'))->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()->label(__('حذف المحدد')),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped();
    }

    /**
     * ---------- Pages ----------
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListWhyChooseUs::route('/'),
            'create' => Pages\CreateWhyChooseUs::route('/create'),
            'edit'   => Pages\EditWhyChooseUs::route('/{record}/edit'),
        ];
    }
}