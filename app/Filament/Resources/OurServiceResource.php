<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurServiceResource\Pages;
use App\Models\OurService;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class OurServiceResource extends Resource
{
    protected static ?string $model = OurService::class;

    protected static ?string $navigationIcon  = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Our Services';
    protected static ?string $pluralLabel     = 'Our Services';
    protected static ?string $modelLabel      = 'Our Service';

    public static function getNavigationGroup(): ?string
    {
        return __('محتوى الموقع');
    }

    public static function getNavigationLabel(): string
    {
        return __('Our Services');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Our Services');
    }

    public static function getModelLabel(): string
    {
        return __('Our Service');
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('Service Information'))
                ->description(__('أدخل بيانات الخدمة والعناصر المرتبطة بها'))
                ->icon('heroicon-o-cog')
                ->collapsible()
                ->schema([
                    TextInput::make('title')
                        ->label(__('Title'))
                        ->required()
                        ->maxLength(150)
                        ->prefixIcon('heroicon-o-document-text')
                        ->columnSpanFull(),

                    TextInput::make('subtitle')
                        ->label(__('Subtitle'))
                        ->required()
                        ->maxLength(250)
                        ->prefixIcon('heroicon-o-chat-bubble-left-right')
                        ->columnSpanFull(),

                    Repeater::make('cards')
                        ->label(__('Cards'))
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->minItems(1)
                        ->reorderable()
                        ->cloneable()
                        ->schema([
                            TextInput::make('icon')
                                ->label(__('Icon'))
                                ->hint(__('ضع كلاس أيقونة مثل heroicon أو fontawesome'))
                                ->prefixIcon('heroicon-o-sparkles'),

                            TextInput::make('title')
                                ->label(__('Card Title'))
                                ->required()
                                ->maxLength(150)
                                ->prefixIcon('heroicon-o-tag'),

                            TextInput::make('subtitle')
                                ->label(__('Card Subtitle'))
                                ->required()
                                ->maxLength(250)
                                ->prefixIcon('heroicon-o-bars-3-bottom-left')
                                ->columnSpanFull(),
                        ])
                        ->columns(2),
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
                    ->limit(50),

                TextColumn::make('subtitle')
                    ->label(__('Subtitle'))
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('cards')
                    ->label(__('Cards'))
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' Cards' : 'No Cards'),
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
            'index'  => Pages\ListOurServices::route('/'),
            'create' => Pages\CreateOurService::route('/create'),
            'edit'   => Pages\EditOurService::route('/{record}/edit'),
        ];
    }
}
