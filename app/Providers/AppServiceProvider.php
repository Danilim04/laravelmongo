<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\GoogleSheetsServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(GoogleSheetsServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
