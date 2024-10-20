<?php

namespace VendorTaro\SpeedTemp;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'nama-paket');

        // Publish assets
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations'),
            __DIR__ . '/resources/views' => resource_path('views/vendor/speedtemp'),
            __DIR__.'/path/to/migrations' => database_path('migrations'),
        ]);
    }

    public function register()
    {
        //
    }
}