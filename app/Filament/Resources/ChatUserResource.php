<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatUserResource\Pages;
use App\Models\ChatUser;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ChatUserResource extends Resource
{
    protected static ?string $model = ChatUser::class;

    protected static ?string $navigationIcon  = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Chat Users';
    protected static ?string $pluralLabel     = 'Chat Users';
    protected static ?string $modelLabel      = 'Chat User';

    /**
     * ---------- Form ----------
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Info')
                    ->description('Basic info of the chat user')
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Phone')
                            ->required()
                            ->maxLength(20)
                            ->unique(ignoreRecord: true),
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
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()->label('Delete'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Delete Selected'),
            ]);
    }

    /**
     * ---------- Pages ----------
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListChatUsers::route('/'),
            'create' => Pages\CreateChatUser::route('/create'),
            'edit'   => Pages\EditChatUser::route('/{record}/edit'),
        ];
    }
}
