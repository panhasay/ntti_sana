<?php

namespace App\Service;

use Kreait\Firebase\Messaging;
use Kreait\Firebase\Exception\FirebaseException;

class FirebaseMessagingService
{
    protected $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function sendNotification($deviceToken, $title, $body, $data = [])
    {
        $message = [
            'token' => $deviceToken,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => $data,
        ];

        try {
            $this->messaging->send($message);
            return true;
        } catch (FirebaseException $e) {
            // Handle the error
            logger()->error($e->getMessage());
            return false;
        }
    }

}
