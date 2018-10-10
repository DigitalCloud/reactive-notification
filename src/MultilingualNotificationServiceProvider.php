<?php

namespace Digitalcloud\MultilingualNotification;

use Illuminate\Support\ServiceProvider;

class MultilingualNotificationServiceProvider extends ServiceProvider
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
