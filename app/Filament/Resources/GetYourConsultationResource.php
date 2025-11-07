<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GetYourConsultationResource\Pages;
use App\Models\GetYourConsultation;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsultationMail;

class GetYourConsultationResource extends Resource
{
    protected static ?string $model = GetYourConsultation::class;
    protected static ?string $navigationIcon  = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationLabel = 'Consultation Requests';
    protected static ?string $pluralLabel     = 'Consultation Requests';
    protected static ?string $modelLabel      = 'Consultation Request';
    protected static ?int $navigationSort     = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('طلبات الموقع');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('Consultation Request Info'))
                ->description(__('الرجاء إدخال بيانات الاستشارة المطلوبة'))
                ->schema([
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->required()
                        ->maxLength(100),

                    TextInput::make('mobile_phone')
                        ->label(__('Mobile Phone'))
                        ->required()
                        ->maxLength(20),

                    TextInput::make('email')
                        ->label(__('Email'))
                        ->email()
                        ->required()
                        ->maxLength(150),

                    Textarea::make('message')
                        ->label(__('Message'))
                        ->rows(6)
                        ->required(),
                ])
                ->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('mobile_phone')
                    ->label(__('Mobile Phone'))
                    ->searchable()
                    ->copyable()
                    ->url(fn ($record) => "tel:{$record->mobile_phone}", true),

                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable()
                    ->copyable()
                    ->url(fn ($record) => "mailto:{$record->email}", true),

                TextColumn::make('message')
                    ->label(__('Message'))
                    ->limit(40)
                    ->tooltip(fn (?GetYourConsultation $record) => $record?->message ?? ''),

                BadgeColumn::make('created_at')
                    ->label(__('Requested At'))
                    ->dateTime('d M Y - H:i')
                    ->color('info'),

                IconColumn::make('is_active')
                    ->label(__('Visible'))
                    ->boolean(),
            ])
            ->filters([
                Filter::make('recent')
                    ->label(__('Recent Requests'))
                    ->query(fn ($query) => $query->latest()),

                Filter::make('email_gmail')
                    ->label(__('Gmail Only'))
                    ->query(fn ($query) => $query->where('email', 'like', '%@gmail.com')),
            ])
            ->actions([
                ViewAction::make()
                    ->label(__('View'))
                    ->modalHeading(fn (?GetYourConsultation $record) =>
                        $record ? "Consultation — {$record->name}" : "Consultation Details"
                    )
                    ->modalWidth('lg')
                    ->modalContent(fn (?GetYourConsultation $record) =>
                        $record ? view('filament.consultations.view', ['record' => $record]) : null
                    ),

                DeleteAction::make()->label(__('Delete'))->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()->label(__('Delete Selected')),

              BulkAction::make('send_email')
    ->label('Send Email')
    ->form([
        TextInput::make('subject')
            ->label('Subject')
            ->required()
            ->maxLength(255)
            ->placeholder('Enter the subject of the email'),

        Textarea::make('email_content')
            ->label('Email Message')
            ->required()
            ->placeholder('Enter the content of the email')
    ])
    ->action(function (array $data, $records) {
        foreach ($records as $record) {
            Mail::to($record->email)
                ->send(new ConsultationMail($record, $data['subject'], $data['email_content']));
        }
    })
    ->deselectRecordsAfterCompletion()
    ->requiresConfirmation()
    ->modalHeading('Send Email to Selected Users')
    ->modalButton('Send')
    ->requiresConfirmation()
    ->deselectRecordsAfterCompletion(),

        ])
        ->defaultSort('created_at', 'desc')
        ->striped()
            ->selectable();

    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGetYourConsultations::route('/'),
            'create' => Pages\CreateGetYourConsultation::route('/create'),
            'edit'   => Pages\EditGetYourConsultation::route('/{record}/edit'),
        ];
    }
}