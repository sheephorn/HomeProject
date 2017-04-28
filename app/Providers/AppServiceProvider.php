<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('RouteCreater', function ($app) {
            return new \App\Helpers\RouteCreater;
        });
        $this->app->singleton('CodeCreater', function ($app) {
            return new \App\Helpers\CodeCreater;
        });
        $this->app->singleton('MessageCreater', function ($app) {
            return new \App\Helpers\MessageCreater;
        });
    }
}
