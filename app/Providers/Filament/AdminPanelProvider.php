<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\SpatieLaravelTranslatablePlugin;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        ->login()

        ->colors([
            'primary' => Color::Amber,
        ])

        ->font('Inter')

        ->plugin(
            SpatieLaravelTranslatablePlugin::make()
                ->defaultLocales(['en', 'ar'])
        )

        ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
        ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
        ->pages([
            Pages\Dashboard::class,
        ])
        ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
        ->widgets([
            // Row 1: Main Stats Overview (4 cards)
            \App\Filament\Widgets\StatsOverviewWidget::class,
            
            // Row 2: Quick Stats (3 cards in one widget)
            \App\Filament\Widgets\QuickStatsWidget::class,
            
            // Row 3: Charts Side by Side
            \App\Filament\Widgets\ConsultationRequestsChart::class,
            \App\Filament\Widgets\ContentDistributionChart::class,
            
            // Row 4: More Charts
            \App\Filament\Widgets\ServicesAndValuesChart::class,
            \App\Filament\Widgets\MonthlyConsultationsChart::class,
            
            // Row 5: Activity & Latest Consultations
            \App\Filament\Widgets\RecentActivityWidget::class,
            \App\Filament\Widgets\LatestConsultationsWidget::class,
        ])
        ->middleware([
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ])
        ->authMiddleware([
            Authenticate::class,
        ]);
}
}