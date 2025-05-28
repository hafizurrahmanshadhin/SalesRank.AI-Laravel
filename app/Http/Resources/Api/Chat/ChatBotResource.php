<?php

namespace App\Http\Resources\Api\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatBotResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    // public function toArray($request): array {
    //     return [
    //         'response'             => $this->resource['response'] ?? null,
    //         'conversation_history' => $this->resource['conversation_history'] ?? [],
    //     ];
    // }

    public function toArray(Request $request): array {
        $response = $this->resource['response'] ?? [];

        return [
            'content'              => $response['choices'][0]['message']['content'] ?? '',
            'conversation_history' => $this->resource['conversation_history'] ?? [],
            // 'usage'                => [
            //     'prompt_tokens'     => $response['usage']['prompt_tokens'] ?? 0,
            //     'completion_tokens' => $response['usage']['completion_tokens'] ?? 0,
            //     'total_tokens'      => $response['usage']['total_tokens'] ?? 0,
            // ],
            // 'model'                => $response['model'] ?? null,
            // 'created_at'           => isset($response['created']) ? date('Y-m-d H:i:s', $response['created']) : null,
        ];
    }
}
