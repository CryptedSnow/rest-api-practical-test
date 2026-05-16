<?php

namespace App\Providers;

use App\Repositories\Interfaces\PlaceInterface;
use App\Repositories\Services\PlaceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PlaceInterface::class,
            PlaceService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
