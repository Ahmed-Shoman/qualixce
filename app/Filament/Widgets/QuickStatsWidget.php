<?php

// namespace App\Filament\Widgets;

// use App\Models\GetYourConsultation;
// use App\Models\HeroSection;
// use App\Models\OurService;
// use Filament\Widgets\Widget;

// class QuickStatsWidget extends Widget
// {
//     protected static string $view = 'filament.widgets.quick-stats';
//     protected static ?int $sort = 7;

//     public function getStats(): array
//     {
//         $todayConsultations = GetYourConsultation::whereDate('created_at', today())->count();
//         $weekConsultations = GetYourConsultation::where('created_at', '>=', now()->subDays(7))->count();
//         $totalContent = HeroSection::count() + OurService::count();

//         return [
//             [
//                 'label' => __('Today'),
//                 'value' => $todayConsultations,
//                 'icon' => 'heroicon-o-calendar',
//                 'color' => 'success',
//                 'description' => __('Consultations today'),
//             ],
//             [
//                 'label' => __('This Week'),
//                 'value' => $weekConsultations,
//                 'icon' => 'heroicon-o-calendar-days',
//                 'color' => 'warning',
//                 'description' => __('Consultations this week'),
//             ],
//             [
//                 'label' => __('Total Content'),
//                 'value' => $totalContent,
//                 'icon' => 'heroicon-o-document-duplicate',
//                 'color' => 'info',
//                 'description' => __('Active content items'),
//             ],
//         ];
//     }
// }