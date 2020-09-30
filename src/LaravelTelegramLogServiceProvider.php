<?php

namespace Defstudio\LaravelTelegramLog;

use Defstudio\LaravelTelegramLog\Commands\LaravelTelegramLogCommand;
use Illuminate\Support\ServiceProvider;

class LaravelTelegramLogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-telegram-log.php' => config_path('laravel-telegram-log.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-telegram-log.php', 'laravel-telegram-log');
    }


}
