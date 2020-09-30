# Laravel Telegram Handler 

This is a monolog telegram handler for laravel applications

## Installation

You can install the package via composer:

```bash
composer require defstudio/laravel-telegram-log
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Defstudio\LaravelTelegramLog\LaravelTelegramLogServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'bot_token' => env('TELEGRAM_BOT_TOKEN'),
    'chat_id' => env('TELEGRAM_CHAT_ID'),
];
```

## Usage

Add the new Log Channel in **config/logging.php**:

```php
'telegram' => [
    'driver' => 'custom',
    'via'    => LaravelTelegramLog::class,
    'level'  => 'error',
],
```

If you use the **stack channel** as default logger, you can just the telegram channel to your stack:

```php
'stack' => [
    'driver' => 'stack',
    'channels' => ['single', 'telegram'],
]
```

Or you can simply change the default logging channel in the .env file.

```bash
LOG_CHANNEL=telegram
```

Great! Your Laravel project can now send logs to your Telegram chat.

You can use **Laravel Log Facade** to send logs to your chat:

```php
// Use the Laravel Log Facade
use Illuminate\Support\Facades\Log;
...

// All Laravel log leves are avaiable
Log::channel('telegram')->emergency($message);
Log::channel('telegram')->alert($message);
Log::channel('telegram')->critical($message);
Log::channel('telegram')->error($message);
Log::channel('telegram')->warning($message);
Log::channel('telegram')->notice($message);
Log::channel('telegram')->info($message);
Log::channel('telegram')->debug($message);
```

# Telegram Instructions

Instructions for creating a new Telegram Bot and getting chat_id from a particular group or chat.

## Creating a Bot

1. Go to [@BotFather](https://t.me/botfather) on Telegram.

2. Send `/newbot`, to start creating a new Bot.

   ![message](https://i.imgur.com/M2KEEp2.png)

3. Set the bot's username and username.

   ![defines-a-bot-name](https://i.imgur.com/ixpfVfQ.png)

4. Now you need to allow your Bot to send direct messages, so send `/setjoingroups` to @BotFather, select your Bot and click Enable:

   ![set-join-group](https://i.imgur.com/TCk4WkC.png)

5. Get the Bot token and add it to your .env file.

   ![get-bot-token](https://i.imgur.com/EwrhvmU.png)

   Bot Token in .env:

   ![token-in-env-file](https://i.imgur.com/SniTiQt.png)

## Getting a Telegram Chat ID

- If you want to send messages to a group:

  1. Add your Bot to a Telegram group.
  2. Send any message from another user to this group.

- If you want send direct messages to a user:

  1. Search for your bot name, and select the chat.
  2. Send `/start` to your Bot.

3. Visit the following link to get updates about your bot and get chat_id:

   https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/getUpdates

Replace all **X** in the URL with your **Bot Token**.

4. Search for the chat that you want to send messages, and get the **chat->id**:

   ![get-a-chat-id](https://i.imgur.com/EJIVfWc.png)

5. Add it to your .env file:

   ![env](https://i.imgur.com/aqRdV1S.png)


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Fabio Ivona](https://github.com/FabioIvona)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
