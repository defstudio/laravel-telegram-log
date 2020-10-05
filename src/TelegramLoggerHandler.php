<?php


namespace Defstudio\LaravelTelegramLog;


use Defstudio\LaravelTelegramLog\Services\TelegramService;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class TelegramLoggerHandler extends AbstractProcessingHandler
{
    private string $application_name;

    private string $application_environment;

    private string $application_url;

    private TelegramService $telegram_service;


    public function __construct($log_level)
    {
        parent::__construct(Logger::toMonologLevel($log_level));

        $this->application_name = config('app.name');
        $this->application_environment = config('app.env');
        $this->application_url = config('app.url');


        $telegram_bot_token = config('laravel-telegram-log.bot_token');
        $telegram_chat_id = config('laravel-telegram-log.chat_id');


        $this->telegram_service = new TelegramService($telegram_bot_token, $telegram_chat_id);
    }

    public function write(array $record): void
    {
        $this->telegram_service->send_message($this->format_log($record));
    }

    protected function format_log(array $log): string
    {


        $text = "<b>Application:</b> {$this->application_name} [<a href='{$this->application_url}'>{$this->application_url}</a>]" . PHP_EOL;
        $text .= "<b>Environment:</b> {$this->application_environment}" . PHP_EOL;

        $log_level = $log['level_name'];
        $text .= "<b>Log Level:</b> <code>$log_level</code>" . PHP_EOL;

        $message = $log['message'];
        $text .= "<b>Message:</b> <pre>$message</pre>" . PHP_EOL;


        if (!empty($formatted = $log['formatted'])) {
            $text .= "<b>Details:</b> <pre>$formatted</pre>" . PHP_EOL;
        }

        if (!empty($extra = $log['extra'])) {
            $extra = json_encode($extra);
            $text .= "<b>Extra:</b> <code>$extra</code>" . PHP_EOL;
        }


        return $text;
    }
}
