<?php

namespace App\Http\Requests\Api;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewsletterRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name'  => 'required|string',
            'email' => 'required|email',
            'text'  => 'nullable|string',
        ];
    }

    protected function failedValidation(Validator $validator): void {
        throw new HttpResponseException(
            Helper::jsonResponse(false, 'Validation error', 422, null, $validator->errors())
        );
    }
}
