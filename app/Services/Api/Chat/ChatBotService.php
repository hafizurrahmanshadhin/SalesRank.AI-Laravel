<?php

namespace App\Services\Api\Chat;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Throwable;

class ChatBotService {
    protected HttpClient $http;
    public function __construct() {
        $this->http = new HttpClient();
    }

    /**
     * Send messages to OpenAI and return the response + updated history.
     *
     * @param  array  $messages
     * @return array{
     *     error: bool,
     *     error_msg?: string,
     *     response?: array,
     *     conversation_history?: array
     * }
     * @throws ConnectionException
     * @throws RequestException
     * @throws Throwable
     */
    public function handleChat(array $messages): array {
        try {
            $response = Http::withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . config('services.chat_gpt.key'),
                'User-Agent'    => 'Laravel-ChatBot/1.0',
            ])
                ->timeout(120)
                ->connectTimeout(30)
                ->retry(3, 100)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model'       => 'gpt-4',
                    'messages'    => $messages,
                    'temperature' => 0,
                    'max_tokens'  => 2048,
                    'stream'      => false,
                ]);
            $response->throw();
        } catch (ConnectionException $e) {
            return [
                'error'     => true,
                'error_msg' => 'Connection timed out talking to OpenAI. Please try again later.',
            ];
        } catch (RequestException $e) {
            return [
                'error'     => true,
                'error_msg' => 'OpenAI API error: ' . ($e->response?->status() ?? 'Unknown'),
            ];
        } catch (Throwable $e) {
            return [
                'error'     => true,
                'error_msg' => 'Unexpected error: ' . $e->getMessage(),
            ];
        }

        $data = $response->json();
        if (!empty($data['choices'][0]['message'])) {
            $messages[] = $data['choices'][0]['message'];
        }

        return [
            'error'                => false,
            'response'             => $data,
            'conversation_history' => $messages,
        ];
    }
}
