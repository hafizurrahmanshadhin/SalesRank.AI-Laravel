<?php

namespace App\Http\Requests\Api\Chat;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChatBotRequest extends FormRequest {
    /**
     * Authorize the request (checks custom AI secret).
     *
     * @return bool
     */
    public function authorize(): bool {
        return $this->header('X-AI-Secret') === config('services.chat_gpt.secret_token');
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @throws HttpResponseException
     */
    protected function failedAuthorization() {
        throw new HttpResponseException(
            Helper::jsonResponse(false, 'Invalid secret token', 403)
        );
    }

    /**
     * Define validation rules.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'message'                        => 'required|string',
            'conversation_history'           => 'sometimes|array',
            'conversation_history.*.role'    => 'required|string|in:user,assistant,system',
            'conversation_history.*.content' => 'required|string',
        ];
    }

    /**
     * Handle validation failure.
     *
     * @param  Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            Helper::jsonResponse(false, $validator->errors()->first(), 422)
        );
    }
}
