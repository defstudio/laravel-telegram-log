<?php

namespace Defstudio\LaravelTelegramLog;

use Monolog\Logger;

class LaravelTelegramLog
{
    public function __invoke(array $config): Logger
    {
        return new Logger(config('app.name'), [
            new TelegramLoggerHandler($config['level'])
        ]);
    }
}
