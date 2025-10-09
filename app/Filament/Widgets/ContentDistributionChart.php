<?php

namespace App\Filament\Widgets;

use App\Models\HeroSection;
use App\Models\AboutQualixceSection;
use App\Models\ExcellenceArea;
use App\Models\FounderMessage;
use App\Models\OurService;
use App\Models\OurValue;
use App\Models\ProvenProcess;
use App\Models\WhyChooseUs;
use Filament\Widgets\ChartWidget;

class ContentDistributionChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static string $color = 'info';

    public function getHeading(): ?string
    {
        return __('Content Distribution');
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => __('Content Sections'),
                    'data' => [
                        HeroSection::count(),
                        AboutQualixceSection::count(),
                        ExcellenceArea::count(),
                        FounderMessage::count(),
                        OurService::count(),
                        OurValue::count(),
                        ProvenProcess::count(),
                        WhyChooseUs::count(),
                    ],
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(20, 184, 166, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                    ],
                ],
            ],
            'labels' => [
                __('Hero Section'),
                __('About Qualixce'),
                __('Excellence Areas'),
                __('Founder Message'),
                __('Our Services'),
                __('Our Values'),
                __('Proven Processes'),
                __('Why Choose Us'),
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
