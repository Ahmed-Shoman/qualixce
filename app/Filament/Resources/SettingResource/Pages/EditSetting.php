<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\Setting;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected static ?string $title = 'Edit Settings';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount($record = null): void
    {
        $record = $record ?? Setting::first() ?? Setting::create([
            'primary_color_light' => '#ffffff',
            'secondary_color_light' => '#f4f4f4',
            'primary_color_dark' => '#000000',
            'secondary_color_dark' => '#1a1a1a',
            'font_family_ar' => 'Cairo',
            'font_family_en' => 'Roboto',
        ]);

        parent::mount($record->getKey());
    }
}
