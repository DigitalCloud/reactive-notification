<?php

namespace Digitalcloud\ReactiveNotification;

use Illuminate\Support\ServiceProvider;

class ReactiveNotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishMigrations();
    }

    private function publishMigrations()
    {
        $path = $this->getMigrationsPath();
        $this->publishes([$path => database_path('migrations')], 'migrations');
    }

    private function getMigrationsPath()
    {
        return __DIR__ . '/database/migrations/';
    }
}
