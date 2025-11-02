<?php

// namespace App\Filament\Widgets;

// use App\Models\GetYourConsultation;
// use App\Models\HeroSection;
// use App\Models\OurService;
// use Filament\Widgets\Widget;
// use Illuminate\Support\Collection;

// class RecentActivityWidget extends Widget
// {
//     protected static string $view = 'filament.widgets.recent-activity';
//     protected static ?int $sort = 6;
//     protected int | string | array $columnSpan = 'full';

//     public function getRecentActivities(): Collection
//     {
//         $activities = collect();

//         // Get recent consultations
//         GetYourConsultation::latest()->limit(3)->get()->each(function ($consultation) use ($activities) {
//             $activities->push([
//                 'type' => 'consultation',
//                 'icon' => 'heroicon-o-chat-bubble-left-ellipsis',
//                 'color' => 'warning',
//                 'title' => __('New consultation request from') . ' ' . $consultation->name,
//                 'description' => $consultation->email,
//                 'time' => $consultation->created_at,
//             ]);
//         });

//         // Get recently updated content
//         HeroSection::latest('updated_at')->limit(2)->get()->each(function ($hero) use ($activities) {
//             $activities->push([
//                 'type' => 'content',
//                 'icon' => 'heroicon-o-star',
//                 'color' => 'success',
//                 'title' => __('Hero Section updated'),
//                 'description' => $hero->title,
//                 'time' => $hero->updated_at,
//             ]);
//         });

//         OurService::latest('updated_at')->limit(2)->get()->each(function ($service) use ($activities) {
//             $activities->push([
//                 'type' => 'service',
//                 'icon' => 'heroicon-o-cog',
//                 'color' => 'info',
//                 'title' => __('Service updated'),
//                 'description' => $service->title,
//                 'time' => $service->updated_at,
//             ]);
//         });

//         return $activities->sortByDesc('time')->take(7);
//     }
// }
