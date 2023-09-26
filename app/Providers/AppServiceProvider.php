<?php

namespace App\Providers;

use App\Services\Images\CatsService;
use App\Services\Images\TheCatApiService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CatsService::class,
            TheCatApiService::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https');
    }
}
