<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest {
    private Helper $helper;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            'first_name'              => 'required|string|max:255',
            'last_name'               => 'required|string|max:255',
            'user_name'               => 'required|string|unique:users,user_name',
            'email'                   => 'required|string|email|max:255|unique:users,email',
            'password'                => 'required|string|min:8|confirmed',
            'role'                    => 'required|in:sales_professional,hiring_company',
            'phone_number'            => 'required|string|unique:profiles,phone_number',
            'linkedin_profile_url'    => 'nullable|url',
            'revenue_generated_year'  => 'nullable|integer',
            'revenue_generated'       => 'nullable|numeric',
            'industry_experience'     => 'nullable|numeric',
            'present_club_experience' => 'nullable|numeric',
            'lead_close_ratio'        => 'nullable|numeric',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void {
        $response = $this->helper->jsonResponse(false, 'Validation failed', 422, ['errors' => $validator->errors()], 422);
        throw new ValidationException($validator, $response);
    }
}
