<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    // ...

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Optional callback
            try {
                $this->telegram([
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => collect($e->getTrace())->take(5), // Optional: limit trace lines
                ]);
            } catch (\Throwable $e) {
                Log::error("Failed to send Telegram error: " . $e->getMessage());
            }
        });
    }
    public function telegram(array $error)
    {
        $bot_api = "https://api.telegram.org";
        $telegram_id = "5773722510";
        $telegram_token = "6554895672:AAHK0heN3rKeo0nIJB8ovW4MgNq9_09XS1o";

        $user = Auth::user();
        $userEmail = $user ? $user->email : 'Guest';

        // Markdown escape helper
        $escape = fn($text) => preg_replace('/([_*\[\]()~`>#+=|{}.!-])/', '\\\\$1', $text);

        $text = "🚨 *Laravel Error Alert* 🚨\n";
        $text .= "👤 *User*: " . $escape($userEmail) . "\n";
        $text .= "📄 *File*: " . $escape($error['file']) . "\n";
        $text .= "📍 *Line*: " . $escape($error['line']) . "\n";
        $text .= "🌐 *URL*: " . $escape(request()->fullUrl()) . "\n";
        $text .= "🧾 *Error*: `" . $escape($error['message']) . "`";

        // Optional: add trace summary
        if (isset($error['trace'])) {
            $text .= "\n\n*Trace:*";
            foreach ($error['trace'] as $i => $trace) {
                if (isset($trace['file'], $trace['line'])) {
                    $text .= "\n" . $escape("{$i}. {$trace['file']}:{$trace['line']}");
                }
            }
        }

        $params = [
            'chat_id' => $telegram_id,
            'text' => $text,
            'parse_mode' => 'MarkdownV2'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$bot_api/bot$telegram_token/sendMessage");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_exec($ch);
        curl_close($ch);
    }
}
