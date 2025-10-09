<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurValueResource\Pages;
use App\Models\OurValue;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class OurValueResource extends Resource
{
    use Translatable;

    protected static ?string $model = OurValue::class;

    protected static ?string $navigationIcon  = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Our Values';

    public static function getNavigationGroup(): ?string
    {
        return __('محتوى الموقع');
    }

    public static function getNavigationLabel(): string
    {
        return __('Our Values');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Our Values');
    }

    public static function getModelLabel(): string
    {
        return __('Our Value');
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('Our Values'))
                ->description(__('أدخل القيم الأساسية وعناصرها'))
                ->schema([
                    Repeater::make('cards')
                        ->label(__('Cards'))
                        ->collapsible()
                        ->minItems(1)
                        ->schema([
                            TextInput::make('title')
                                ->label(__('Card Title'))
                                ->required()
                                ->maxLength(150),

                            TextInput::make('subtitle')
                                ->label(__('Card Subtitle'))
                                ->required()
                                ->maxLength(250),
                        ])
                        ->columns(2),
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
            'index'  => Pages\ListOurValues::route('/'),
            'create' => Pages\CreateOurValue::route('/create'),
            'edit'   => Pages\EditOurValue::route('/{record}/edit'),
        ];
    }
}