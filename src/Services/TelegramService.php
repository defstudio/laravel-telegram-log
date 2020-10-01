<?php


namespace Defstudio\LaravelTelegramLog\Services;


use Exception;

class TelegramService
{

    const RESPONSE_MESSAGES = [
        '200' => 'Message has been sent.',
        '400' => 'Chat ID is not valid.',
        '401' => 'Bot Token is not valid.',
        '404' => 'Bot Token is not valid.',
    ];

    private string $telegram_api_base_url;

    private string $telegram_api_send_message_endpoint;

    private ?string $telegram_bot_token;

    private ?string $telegram_chat_id;

    public function __construct(?string $telegram_bot_token, ?string $telegram_chat_id)
    {

        $this->telegram_api_base_url = 'https://api.telegram.org/bot';
        $this->telegram_api_send_message_endpoint = 'sendMessage';
        $this->telegram_bot_token = $telegram_bot_token;
        $this->telegram_chat_id = $telegram_chat_id;

    }

    public function send_message(string $message): string
    {
        $url = $this->telegram_api_base_url . $this->telegram_bot_token . '/' . $this->telegram_api_send_message_endpoint;
        $query = $this->prepare_query($message);

        try {
            $status_code = $this->get_response_status_code("$url?$query");

            return $this->get_response_from_status_code($status_code);
        } catch (Exception $exception) {
        }

        return 'Exception occourred';
    }

    private function prepare_query(string $message): string
    {
        return http_build_query([
            'text' => $message,
            'chat_id' => $this->telegram_chat_id,
            'parse_mode' => 'html',
        ]);
    }

    private function get_response_status_code($url): string
    {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

    private function get_response_from_status_code($status_code): ?string
    {
        return self::RESPONSE_MESSAGES[$status_code] ?? null;
    }
}
