<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurValueResource\Pages;
use App\Models\OurValue;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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
use Filament\Tables\Actions\ViewAction;

class OurValueResource extends Resource
{
    use Translatable;

    protected static ?string $model = OurValue::class;

    protected static ?string $navigationIcon  = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Our Values';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }


    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Translations')
                ->tabs([
                    Tab::make('English')
                        ->schema([
                            Section::make('Our Values (EN)')
                                ->schema([
                                    Repeater::make('cards')
                                        ->label('Cards')
                                        ->collapsible()
                                        ->collapsed(false)
                                        ->defaultItems(1)
                                        ->itemLabel(fn(array $state) => $state['title']['en'] ?? 'New Card')
                                        ->addActionLabel('➥ Add new card')
                                        ->reorderable()
                                        ->cloneable()
                                        ->schema([
                                            TextInput::make('icon')
                                                ->label('Icon class (e.g. "fa-solid fa-star")')
                                                ->helperText('Use FontAwesome or custom class.')
                                                ->maxLength(150),
                                            TextInput::make('title.en')
                                                ->label('Title (EN)')
                                                ->required()
                                                ->maxLength(150),
                                            TextInput::make('subtitle.en')
                                                ->label('Subtitle (EN)')
                                                ->required()
                                                ->maxLength(250),
                                        ])
                                        ->columns(1),
                                ]),
                        ]),

                    Tab::make('العربية')
                        ->schema([
                            Section::make('الكروت (AR)')
                                ->schema([
                                    Repeater::make('cards')
                                        ->label('الكروت')
                                        ->collapsible()
                                        ->collapsed(false)
                                        ->defaultItems(1)
                                        ->itemLabel(fn(array $state) => $state['title']['ar'] ?? 'كارت جديد')
                                        ->addActionLabel('➥ إضافة كارت جديد')
                                        ->reorderable()
                                        ->cloneable()
                                        ->schema([
                                            TextInput::make('icon')
                                                ->label('أيقونة (Icon)')
                                                ->helperText('اكتب كود الأيقونة مثل "fa-solid fa-heart"')
                                                ->maxLength(150),
                                            TextInput::make('title.ar')
                                                ->label('العنوان (AR)')
                                                ->required()
                                                ->maxLength(150),
                                            TextInput::make('subtitle.ar')
                                                ->label('الوصف (AR)')
                                                ->required()
                                                ->maxLength(250),
                                        ])
                                        ->columns(1),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('cards')
                    ->label('Cards Count')
                    ->colors([
                        'danger'  => fn($state) => is_array($state) && count($state) < 1,
                        'warning' => fn($state) => is_array($state) && count($state) < 3,
                        'success' => fn($state) => is_array($state) && count($state) >= 3,
                    ])
                    ->formatStateUsing(fn($state) => is_array($state) ? count($state) . ' Cards' : '0'),
            ])
            ->actions([
                ViewAction::make()->label(__('View')),
                EditAction::make()->label(__('Edit')),
                DeleteAction::make()->label(__('Delete'))->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()->label(__('Delete Selected')),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped();
    }


    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOurValues::route('/'),
            'create' => Pages\CreateOurValue::route('/create'),
            'edit'   => Pages\EditOurValue::route('/{record}/edit'),
        ];
    }
}