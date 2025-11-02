<?php

// namespace App\Filament\Widgets;

// use App\Models\GetYourConsultation;
// use Filament\Widgets\ChartWidget;

// class MonthlyConsultationsChart extends ChartWidget
// {
//     protected static ?int $sort = 8;

//     public function getHeading(): ?string
//     {
//         return __('Monthly Consultation Trends');
//     }

//     protected function getData(): array
//     {
//         $months = [];
//         $data = [];

//         for ($i = 5; $i >= 0; $i--) {
//             $date = now()->subMonths($i);
//             $months[] = $date->format('M Y');

//             $count = GetYourConsultation::whereYear('created_at', $date->year)
//                 ->whereMonth('created_at', $date->month)
//                 ->count();

//             $data[] = $count;
//         }

//         return [
//             'datasets' => [
//                 [
//                     'label' => __('Consultations'),
//                     'data' => $data,
//                     'backgroundColor' => 'rgba(139, 92, 246, 0.1)',
//                     'borderColor' => 'rgb(139, 92, 246)',
//                     'fill' => true,
//                     'tension' => 0.4,
//                 ],
//             ],
//             'labels' => $months,
//         ];
//     }

//     protected function getType(): string
//     {
//         return 'line';
//     }
// }