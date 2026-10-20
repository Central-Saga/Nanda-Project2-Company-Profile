<?php

namespace App\Providers;

use App\Models\SiteProfile;
use Illuminate\Support\Facades\View;
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
        View::composer(['layouts.public', 'public.*', 'errors.404'], function ($view) {
            $view->with('siteProfile', SiteProfile::first());
        });
    }
}
