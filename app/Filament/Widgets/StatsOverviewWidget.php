<?php

namespace App\Filament\Widgets;

use App\Models\HeroSection;
use App\Models\AboutQualixceSection;
use App\Models\ExcellenceArea;
use App\Models\FounderMessage;
use App\Models\GetYourConsultation;
use App\Models\OurService;
use App\Models\OurValue;
use App\Models\ProvenProcess;
use App\Models\WhyChooseUs;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make(__('Total Content Sections'), $this->getTotalContentSections())
                ->description(__('All content sections'))
                ->descriptionIcon('heroicon-o-document-duplicate')
                ->color('success')
                ->chart([7, 12, 15, 18, 22, 25, 28]),

            Stat::make(__('Consultation Requests'), GetYourConsultation::count())
                ->description(__('Total consultation requests'))
                ->descriptionIcon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('warning')
                ->chart($this->getConsultationChart()),

            Stat::make(__('Services'), OurService::count())
                ->description(__('Active services'))
                ->descriptionIcon('heroicon-o-cog')
                ->color('info')
                ->chart([3, 5, 7, 8, 10, 12, 15]),

            Stat::make(__('Excellence Areas'), ExcellenceArea::count())
                ->description(__('Areas of excellence'))
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('primary')
                ->chart([2, 4, 6, 8, 10, 12, 14]),
        ];
    }

    protected function getTotalContentSections(): int
    {
        return HeroSection::count() +
               AboutQualixceSection::count() +
               ExcellenceArea::count() +
               FounderMessage::count() +
               OurService::count() +
               OurValue::count() +
               ProvenProcess::count() +
               WhyChooseUs::count();
    }

    protected function getConsultationChart(): array
    {
        $consultations = GetYourConsultation::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();

        return array_pad($consultations, 7, 0);
    }
}
