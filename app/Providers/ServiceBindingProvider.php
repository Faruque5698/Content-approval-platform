<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceBindingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $services = [
            'Post',
            'Category',
            'Tag',
        ];

        foreach ($services as $service) {
            $interface = "App\\Services\\$service\\{$service}ServiceInterface";
            $implementation = "App\\Services\\$service\\{$service}Service";

            if (interface_exists($interface) && class_exists($implementation)) {
                $this->app->bind($interface, $implementation);
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
