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
    public function toArray(Request $request): array {
        return [
            'success'              => $this['success'],
            'message'              => $this['message'],
            'response'             => $this['response'], // raw OpenAI payload
            'conversation_history' => $this['conversation_history'], // full history
        ];
    }
}
