<?php

namespace App\Http\Controllers\Api\Chat;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatBotController extends Controller {
    public function __invoke(Request $request): JsonResponse {
        if ($request->header('X-AI-Secret') !== env('CUSTOM_AI_SECRET_TOKEN')) {
            return Helper::jsonResponse(false, 'Invalid secret token', 403);
        }

        // Validate input
        $request->validate([
            'message'                        => 'required|string',
            'conversation_history'           => 'sometimes|array',
            'conversation_history.*.role'    => 'required|string|in:user,assistant,system',
            'conversation_history.*.content' => 'required|string',
        ]);

        // Get conversation history or initialize empty array
        $messages = $request->input('conversation_history', []);

        // Add the new message
        $messages[] = [
            'role'    => 'user',
            'content' => $request->input('message'),
        ];

        $response = Http::withHeaders([
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model'       => 'gpt-4',
            'messages'    => $messages,
            'temperature' => 0,
            'max_tokens'  => 2048,
        ]);

        if ($response->failed()) {
            return Helper::jsonResponse(false, 'Failed to get AI response', 500);
        }

        $responseData = $response->json();

        // Add the assistant's response to conversation history
        if (isset($responseData['choices'][0]['message'])) {
            $messages[] = $responseData['choices'][0]['message'];
        }

        // Return response with updated conversation history
        return Helper::jsonResponse(true, "AI response received", 200, [
            'response'             => $responseData,
            'conversation_history' => $messages,
        ]);
    }
}
