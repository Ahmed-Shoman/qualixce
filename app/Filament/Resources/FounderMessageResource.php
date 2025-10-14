<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FounderMessageResource\Pages;
use App\Models\FounderMessage;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Translations')
                ->tabs([
                    Tab::make('English')
                        ->schema([
                            Section::make('Founder Message (EN)')
                                ->schema([
                                    TextInput::make('name.en')
                                        ->label('Name (EN)')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('position.en')
                                        ->label('Position (EN)')
                                        ->required()
                                        ->maxLength(255),

                                    Textarea::make('message.en')
                                        ->label('Message (EN)')
                                        ->required()
                                        ->rows(5),
                                ])
                                ->columns(1),
                        ]),

                    Tab::make('العربية')
                        ->schema([
                            Section::make('رسالة المؤسس (AR)')
                                ->schema([
                                    TextInput::make('name.ar')
                                        ->label('الاسم (AR)')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('position.ar')
                                        ->label('المنصب (AR)')
                                        ->required()
                                        ->maxLength(255),

                                    Textarea::make('message.ar')
                                        ->label('رسالة المؤسس (AR)')
                                        ->required()
                                        ->rows(5),
                                ])
                                ->columns(1),
                        ]),
                ])
                ->columnSpanFull(),

            Section::make('Founder Image')
                ->description('Upload a professional photo')
                ->schema([
                    FileUpload::make('image')
                        ->label('Founder Image')
                        ->required()
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['1:1', '4:3'])
                        ->directory('founder-messages')
                        ->imagePreviewHeight('200')
                        ->downloadable()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
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
                TextColumn::make('name')
                    ->label('Name (EN)')
                    ->getStateUsing(fn($record) => $record->getTranslation('name', 'en'))
                    ->sortable(),

                TextColumn::make('position')
                    ->label('Position (EN)')
                    ->getStateUsing(fn($record) => $record->getTranslation('position', 'en'))
                    ->sortable(),

                TextColumn::make('message')
                    ->label('Message (EN)')
                    ->getStateUsing(fn($record) => $record->getTranslation('message', 'en'))
                    ->limit(50),

                ImageColumn::make('image')
                    ->label('Image')
                    ->rounded()
                    ->size(80),
            ])
            ->striped()
            ->actions([
                \Filament\Tables\Actions\ViewAction::make()->label('View'),
                \Filament\Tables\Actions\EditAction::make()->label('Edit'),
                \Filament\Tables\Actions\DeleteAction::make()->label('Delete'),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\DeleteBulkAction::make()->label('Delete Selected'),
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
