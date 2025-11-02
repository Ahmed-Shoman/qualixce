<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VisitorCounterWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        // Check if visitor is new (for admin visits)
        if (!Session::has('admin_visitor')) {
            // Get or create the visitor count
            $count = DB::table('visitor_counts')->where('id', 1)->first();
            
            if ($count) {
                DB::table('visitor_counts')
                    ->where('id', 1)
                    ->increment('count');
            } else {
                DB::table('visitor_counts')->insert([
                    'id' => 1,
                    'count' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            // Mark session to prevent counting again
            Session::put('admin_visitor', true);
        }
        
        // Get the current count
        $count = DB::table('visitor_counts')->where('id', 1)->first();
        $visitorCount = $count ? $count->count : 0;

        return [
            Stat::make('Total Visitors', number_format($visitorCount))
                ->description('Number of unique visitors to your site')
                ->descriptionIcon('heroicon-o-users')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}
