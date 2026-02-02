<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatbotMessageResource\Pages;
use App\Models\ChatbotMessage;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

class ChatbotMessageResource extends Resource
{
    protected static ?string $model = ChatbotMessage::class;

    // 👇 Label for the resource in the navigation
    protected static ?string $navigationLabel = 'Chatbot Messages';
    protected static ?string $pluralLabel = 'Chatbot Messages';
    protected static ?string $modelLabel = 'Chatbot Message';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                TextInput::make('user_name')
                    ->label('User Name')
                    ->required(),

                TextInput::make('user_phone')
                    ->label('User Phone')
                    ->required(),

                TextInput::make('session_id')
                    ->label('Session ID')
                    ->numeric()
                    ->required(),
                Repeater::make('messages')
                    ->label('Messages')
                    ->schema([
                        Select::make('sender')
                            ->label('Sender')
                            ->options([
                                'user' => 'User',
                                'bot' => 'Bot',
                            ])
                            ->required(),

                        Textarea::make('text')
                            ->label('Text')
                            ->rows(2)
                            ->required(),

                        Textarea::make('ts')
                            ->label('Timestamp (ts)')
                            ->helperText('Unix timestamp in milliseconds')
                            ->hidden()
                            ->default(fn(): float|int => now()->timestamp * 1000)
                            ->required(),
                    ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->createItemButtonLabel('Add Message'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('ID'),
                TextColumn::make('user_id')->label('User ID')->sortable(),
                TextColumn::make('user_name')->label('Name')->sortable()->searchable(),
                TextColumn::make('user_phone')->label('Phone')->sortable(),
                TextColumn::make('session_id')->label('Session ID')->sortable(),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),

            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatbotMessages::route('/'),
            'create' => Pages\CreateChatbotMessage::route('/create'),
            'edit' => Pages\EditChatbotMessage::route('/{record}/edit'),
        ];
    }
}
