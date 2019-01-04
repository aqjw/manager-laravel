<?php

namespace Aqjw\ManagerLaravel;

use Illuminate\Support\ServiceProvider;

class ManagerLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';

        $this->publishes([
            __DIR__ . '/assets' => public_path('aqjw'),
        ], 'public');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'managerl');

    }
}
