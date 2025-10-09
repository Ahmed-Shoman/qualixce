<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvenProcessResource\Pages;
use App\Models\ProvenProcess;
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

class ProvenProcessResource extends Resource
{
    protected static ?string $model = ProvenProcess::class;

    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Proven Processes';

    public static function getNavigationGroup(): ?string
    {
        return __('محتوى الموقع');
    }

    public static function getNavigationLabel(): string
    {
        return __('Proven Processes');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Proven Processes');
    }

    public static function getModelLabel(): string
    {
        return __('Proven Process');
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('Proven Process Info'))
                ->description(__('إضافة/تعديل بيانات الـ Proven Process'))
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
                ->description(__('إضافة العناصر الخاصة بالـ Process'))
                ->schema([
                    Repeater::make('cards')
                        ->label(__('Cards'))
                        ->collapsible()
                        ->minItems(1)
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
            'index'  => Pages\ListProvenProcesses::route('/'),
            'create' => Pages\CreateProvenProcess::route('/create'),
            'edit'   => Pages\EditProvenProcess::route('/{record}/edit'),
        ];
    }
}