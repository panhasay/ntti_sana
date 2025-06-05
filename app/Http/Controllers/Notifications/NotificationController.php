<?php

namespace App\Http\Controllers\Notifications;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\FirebaseMessagingService;

class NotificationController extends Controller
{
    protected $fcmService;

    public function __construct(FirebaseMessagingService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    public function notifyUser($userId)
    {
        $user = User::find($userId);

        if ($user && $user->fcm_token) {
            return response()->json([
                'status' => 'sucess',
                'data' => $user->fcm_token,
                'message' => 'Notification sent successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'data' => 404,
            'message' => 'User not found or no FCM token'
        ], 404);
    }

    public function saveToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if (!$user instanceof User) {
            return response()->json(['error' => 'User  not found'], 404);
        }
        $user->fcm_token = $request->token;
        $user->save();

        return response()->json(['status' => 'Token stored successfully']);
    }

    public function sendNotification(Request $request, $user_id)
    {
        $response = $this->notifyUser($user_id);
        $responseData = $response->getData();
        if ($responseData->status === 'error' || !isset($responseData->data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found or no FCM token'
            ], 404);
        }
        $fcm_token = $responseData->data;

        $result = $this->fcmService->sendNotification(
            $fcm_token,
            $request->input('title'),
            $request->input('body'),
            $request->input('data') ?? []
        );
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Notification sent successfully.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send notification.'
            ], 500);
        }
    }

    public function Notification($user_id, $title, $body, $data)
    {
        $response = $this->notifyUser($user_id);
        $responseData = $response->getData();
        if ($responseData->status === 'error' || !isset($responseData->data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found or no FCM token'
            ], 404);
        }
        $fcm_token = $responseData->data;

        $result = $this->fcmService->sendNotification(
            $fcm_token,
            $title,
            $body,
            $data ?? []
        );

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Notification sent successfully.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send notification.'
            ], 500);
        }
    }
}
