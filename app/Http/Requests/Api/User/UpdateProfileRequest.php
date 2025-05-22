<?php

namespace App\Http\Requests\Api\User;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateProfileRequest extends FormRequest {
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
            // User fields
            'first_name'   => 'sometimes|string|max:255',
            'last_name'    => 'sometimes|string|max:255',
            'avatar'       => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:20480', // 20MB max

            // Profile fields
            'working_role' => 'sometimes|nullable|string|max:255',
            'country'      => 'sometimes|nullable|string|max:255',
            'bio'          => 'sometimes|nullable|string|max:5000',
        ];
    }

    /**
     * Override failedValidation to return a custom JSON response.
     */
    protected function failedValidation(Validator $validator): void {
        $response = $this->helper->jsonResponse(false, 'Validation failed', 422, ['errors' => $validator->errors()], 422);

        throw new ValidationException($validator, $response);
    }
}
