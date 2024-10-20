<?php

namespace VendorTaro\SpeedTemp\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupPackageCommand extends Command
{
    protected $signature = 'package:setup';
    protected $description = 'Setup and move package files to their respective directories';

    public function handle()
    {
        $this->info('Setting up package...');

        // Move models
        $this->moveFiles(
            __DIR__ . '/../Models',
            app_path('Models'),
            'Models'
        );

        // Move middleware
        $this->moveFiles(
            __DIR__ . '/../Http/Middleware',
            app_path('Http/Middleware'),
            'Middleware'
        );

        // Move Livewire components
        $this->moveFiles(
            __DIR__ . '/../Livewire',
            app_path('Http/Livewire'),
            'Livewire Components'
        );

        // Move routes
        if (File::exists(__DIR__ . '/../Routes/web.php')) {
            $this->addRoutesToFile(
                __DIR__ . '/../Routes/web.php',
                base_path('routes/web.php')
            );
        }

        // Copy config
        if (File::exists(__DIR__ . '/../../config/packagename.php')) {
            File::copy(
                __DIR__ . '/../../config/packagename.php',
                config_path('packagename.php')
            );
            $this->info('Config file copied successfully.');
        }

        $this->info('Package setup completed successfully!');
    }

    protected function moveFiles($source, $destination, $type)
    {
        if (!File::isDirectory($source)) {
            return;
        }

        File::ensureDirectoryExists($destination);

        $files = File::files($source);
        foreach ($files as $file) {
            $newPath = $destination . '/' . $file->getFilename();
            File::copy($file->getPathname(), $newPath);
        }

        $this->info("{$type} moved successfully.");
    }

    protected function addRoutesToFile($source, $destination)
    {
        $packageRoutes = File::get($source);
        File::append($destination, "\n\n// Package Routes\n" . $packageRoutes);
        $this->info('Routes added to web.php successfully.');
    }
}