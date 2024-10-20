<?php

namespace VendorTaro\SpeedTemp;

use Illuminate\Support\ServiceProvider;
use VendorName\PackageName\Console\SetupPackageCommand;

class PackageServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupPackageCommand::class,
            ]);
        }
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'nama-paket');

        // Publish assets
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations'),
            __DIR__ . '/resources/views' => resource_path('views/vendor/speedtemp'),
            __DIR__ . '/path/to/migrations' => database_path('migrations'),
        ]);
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function register()
    {
        //
    }
}