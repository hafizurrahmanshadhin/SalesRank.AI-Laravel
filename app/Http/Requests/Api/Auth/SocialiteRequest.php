<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SocialiteRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'token'    => 'required|string',
            'provider' => 'required|string|in:google',
        ];
    }

    protected function failedValidation(Validator $validator): void {
        throw new HttpResponseException(
            (new Helper())->jsonResponse(false, 'Validation failed', 422, [
                'errors' => $validator->errors(),
            ])
        );
    }
}
