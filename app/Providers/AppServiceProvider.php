<?php

namespace App\Providers;

use App\Helpers\AgencyHelper;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AgencyHelper::class, function($app){
            return new AgencyHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with('agencyHelper', new AgencyHelper);
        });
    }
}
