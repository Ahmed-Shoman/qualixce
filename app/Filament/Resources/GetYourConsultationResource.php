<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GetYourConsultationResource\Pages;
use App\Models\GetYourConsultation;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\Filter;

class GetYourConsultationResource extends Resource
{
    protected static ?string $model = GetYourConsultation::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationLabel = 'Consultation Requests';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    Section::make('Consultation Request Info')->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('mobile_phone')
                            ->label('Mobile Phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(150),

                        Textarea::make('message')
                            ->label('Message')
                            ->rows(6)
                            ->required(),
                    ]),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('mobile_phone')
                    ->label('Mobile Phone')
                    ->searchable()
                    ->copyable()
                    ->url(fn ($record) => "tel:{$record->mobile_phone}", true),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->url(fn ($record) => "mailto:{$record->email}", true),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(40)
                    ->tooltip(fn (?GetYourConsultation $record) => $record?->message ?? ''),

                BadgeColumn::make('created_at')
                    ->label('Requested At')
                    ->dateTime('d M Y - H:i')
                    ->color('info'),
            ])
            ->filters([
                Filter::make('recent')
                    ->label('Recent Requests')
                    ->query(fn ($query) => $query->latest()),

                Filter::make('email_gmail')
                    ->label('Gmail Only')
                    ->query(fn ($query) => $query->where('email', 'like', '%@gmail.com')),
            ])
            ->actions([
                ViewAction::make()
                    ->modalHeading(fn (?GetYourConsultation $record) =>
                        $record ? "Consultation — {$record->name}" : "Consultation Details"
                    )
                    ->modalWidth('lg')
                    ->modalContent(function (?GetYourConsultation $record) {
                        if (! $record) return null;

                        return view('filament.consultations.view', ['record' => $record]);
                    }),

                DeleteAction::make()->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGetYourConsultations::route('/'),
            'create' => Pages\CreateGetYourConsultation::route('/create'),
            'edit' => Pages\EditGetYourConsultation::route('/{record}/edit'),
        ];
    }
}
