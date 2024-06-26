<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Veriler;
use Illuminate\Support\Facades\Cache;

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
        View::composer('*', function ($view) {
            $companyData = Cache::remember('companyData', now()->addDays(1), function () {
                return Veriler::select('marka', 'aciklama', 'anaveri', 'footerveri', 'facebook', 'twitter', 'instagram', 'youtube', 'web', 'adres', 'tel', 'mail')->first();
            });

            $view->with('companyData', $companyData);
        });
    }
}
