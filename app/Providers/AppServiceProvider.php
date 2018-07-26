<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $channels = \Cache::rememberForever('channels', function () {
                return Channel::all();
            });

            $view->with('channels', $channels);
        });
        // \View::share('channels', \App\Channel::all());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            // Providers
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');

            // Aliases
            $this->app->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }
    }
}
