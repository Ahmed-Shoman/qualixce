<?php

namespace App\Filament\Widgets;

use App\Models\GetYourConsultation;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ConsultationRequestsChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static string $color = 'warning';

    public function getHeading(): ?string
    {
        return __('Consultation Requests');
    }

    public ?string $filter = '7';

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $data = GetYourConsultation::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays((int) $activeFilter))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => __('Consultation Requests'),
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => 'rgba(251, 146, 60, 0.1)',
                    'borderColor' => 'rgb(251, 146, 60)',
                    'fill' => true,
                ],
            ],
            'labels' => $data->pluck('date')->map(fn ($date) => date('M d', strtotime($date)))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            '7' => __('Last 7 days'),
            '14' => __('Last 14 days'),
            '30' => __('Last 30 days'),
            '90' => __('Last 90 days'),
        ];
    }
}
