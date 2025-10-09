<?php

namespace App\Filament\Widgets;

use App\Models\OurService;
use App\Models\OurValue;
use App\Models\ProvenProcess;
use App\Models\WhyChooseUs;
use Filament\Widgets\ChartWidget;

class ServicesAndValuesChart extends ChartWidget
{
    protected static ?int $sort = 5;

    public function getHeading(): ?string
    {
        return __('Services & Values Overview');
    }

    protected function getData(): array
    {
        $services = OurService::first();
        $values = OurValue::first();
        $processes = ProvenProcess::first();
        $whyChooseUs = WhyChooseUs::first();

        $servicesCards = $services && is_array($services->cards) ? count($services->cards) : 0;
        $valuesCards = $values && is_array($values->cards) ? count($values->cards) : 0;
        $processesCards = $processes && is_array($processes->cards) ? count($processes->cards) : 0;
        $whyChooseUsCards = $whyChooseUs && is_array($whyChooseUs->cards) ? count($whyChooseUs->cards) : 0;

        return [
            'datasets' => [
                [
                    'label' => __('Number of Cards'),
                    'data' => [$servicesCards, $valuesCards, $processesCards, $whyChooseUsCards],
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                    ],
                    'borderColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(251, 146, 60)',
                        'rgb(139, 92, 246)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => [
                __('Our Services'),
                __('Our Values'),
                __('Proven Processes'),
                __('Why Choose Us'),
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
