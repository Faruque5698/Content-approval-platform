<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $interfacePath = app_path('Repositories/Contracts');

        if (!File::exists($interfacePath)) {
            return;
        }

        foreach (File::allFiles($interfacePath) as $file) {
            $interfaceName = $file->getFilenameWithoutExtension();
            $interfaceClass = "App\\Repositories\\Contracts\\$interfaceName";

            $implementationClass = "App\\Repositories\\Eloquent\\" . str_replace('Interface', '', $interfaceName);

            if (class_exists($implementationClass)) {
                $this->app->bind($interfaceClass, $implementationClass);
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
