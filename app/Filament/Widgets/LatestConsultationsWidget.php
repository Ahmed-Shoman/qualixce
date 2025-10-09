<?php

namespace App\Filament\Widgets;

use App\Models\GetYourConsultation;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestConsultationsWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                GetYourConsultation::query()->latest()->limit(5)
            )
            ->heading(__('Latest Consultation Requests'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->icon('heroicon-o-user')
                    ->iconColor('primary')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->iconColor('info')
                    ->copyable()
                    ->url(fn ($record) => "mailto:{$record->email}", true),

                Tables\Columns\TextColumn::make('mobile_phone')
                    ->label(__('Mobile Phone'))
                    ->icon('heroicon-o-phone')
                    ->iconColor('success')
                    ->copyable()
                    ->url(fn ($record) => "tel:{$record->mobile_phone}", true),

                Tables\Columns\TextColumn::make('message')
                    ->label(__('Message'))
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->message)
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Requested At'))
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-o-clock'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label(__('View'))
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalHeading(fn ($record) => __('Consultation Request') . ' - ' . $record->name)
                    ->modalContent(fn ($record) => view('filament.widgets.consultation-details', ['record' => $record])),
            ]);
    }

    public static function getHeading(): string
    {
        return __('Latest Consultation Requests');
    }
}
