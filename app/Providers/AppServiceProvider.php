<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 👇 استخدم اللغة المحفوظة في الـ session من الإضافة FilamentLanguageSwitch
        if (session()->has('filament_locale')) {
            App::setLocale(session('filament_locale'));
        } else {
            // 👇 الافتراضي
            App::setLocale(config('app.locale', 'en'));
        }
    }
}
