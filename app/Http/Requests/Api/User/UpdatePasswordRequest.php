<?php

namespace App\Http\Requests\Api\User;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdatePasswordRequest extends FormRequest {
    private Helper $helper;

    /**
     * Inject helper class for custom JSON responses.
     */
    public function __construct(Helper $helper) {
        $this->helper = $helper;
        parent::__construct();
    }

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
            'current_password'          => 'required',
            'new_password'              => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ];
    }

    /**
     * Specify custom validation messages for each rule.
     */
    public function messages(): array {
        return [
            'current_password.required'          => 'Please enter your current password.',
            'new_password.required'              => 'A new password is required.',
            'new_password.min'                   => 'Your new password must be at least :min characters.',
            'new_password.confirmed'             => 'Your new password fields do not match.',
            'new_password_confirmation.required' => 'Please confirm your new password.',
        ];
    }

    /**
     * Override failedValidation to return a custom JSON response.
     *
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void {
        $response = $this->helper->jsonResponse(false, 'Validation failed', 422, ['errors' => $validator->errors()], 422);

        throw new ValidationException($validator, $response);
    }
}
