<?php

namespace App\Http\Controllers\Api\Chat;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Chat\ChatBotRequest;
use App\Http\Resources\Api\Chat\ChatBotResource;
use App\Services\Api\Chat\ChatBotService;
use Exception;
use Illuminate\Http\JsonResponse;

class ChatBotController extends Controller {
    protected ChatBotService $chatBotService;
    public function __construct(ChatBotService $chatBotService) {
        $this->chatBotService = $chatBotService;
    }

    /**
     * Handle the incoming ChatBotRequest.
     *
     * @param  ChatBotRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(ChatBotRequest $request): JsonResponse {
        try {
            $messages   = $request->input('conversation_history', []);
            $messages[] = [
                'role'    => 'user',
                'content' => $request->input('message'),
            ];

            $serviceResult = $this->chatBotService->handleChat($messages);

            if ($serviceResult['error']) {
                return Helper::jsonResponse(false, $serviceResult['error_msg'], 500);
            }

            return Helper::jsonResponse(true, 'AI response received', 200,
                new ChatBotResource([
                    'response'             => $serviceResult['response'],
                    'conversation_history' => $serviceResult['conversation_history'],
                ])
            );
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
