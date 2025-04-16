<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest {
    use ApiResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation(): void {
        // If client sent 'username', use that; otherwise if they still send 'handle', use that.
        if ($this->filled('username') || $this->filled('handle')) {
            $this->merge([
                'handle' => $this->input('username') ?? $this->input('handle'),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'role'                    => 'required|integer|exists:roles,id',
            'handle'                  => 'required|string|unique:users,handle',
            'email'                   => 'required|string|email|max:255|unique:users,email',
            'password'                => 'required|confirmed',
            'first_name'              => 'required|string',
            'last_name'               => 'required|string',
            'phone_number'            => 'required|unique:profiles,phone_number',
            'linkedin_profile_url'    => 'nullable|string',
            'revenue_generated_year'  => 'nullable|integer',
            'revenue_generated'       => 'nullable|numeric',
            'industry_experience'     => 'nullable|numeric',
            'present_club_experience' => 'nullable|numeric',
            'lead_close_ratio'        => 'nullable|numeric',
        ];
    }

    /**
     * Define the custom validation error messages.
     *
     * @return array The custom error messages for validation rules.
     */
    public function messages(): array {
        return [
            'first_name.required'   => 'First name is required.',
            'first_name.string'     => 'First name must be a string.',

            'last_name.required'    => 'Last name is required.',
            'last_name.string'      => 'Last name must be a string.',

            'email.required'        => 'Email address is required.',
            'email.email'           => 'Email address must be a valid email format.',
            'email.unique'          => 'This email is already taken.',

            'password.required'     => 'Password is required.',
            'password.confirmed'    => 'Passwords do not match.',

            'role.required'         => 'Role is required.',
            'role.integer'          => 'Role must be a valid integer.',
            'role.exists'           => 'Role does not exist in the system.',
            'handle.required'       => 'Username is required.',
            'handle.unique'         => 'This username is already taken.',
            'phone_number.required' => 'Phone number is required.',
            'phone_number.unique'   => 'This phone number is already taken.',
        ];
    }

    /**
     * Handles failed validation by formatting the validation errors and throwing a ValidationException.
     *
     * This method is called when validation fails in a form request. It uses the `error` method
     * from the `ApiResponse` trait to generate a standardized Error response with the validation
     * Error messages and a 422 HTTP status code. It then throws a `ValidationException` with the
     * formatted response.
     *
     * @param Validator $validator The validator instance containing the validation errors.
     *
     * @return void Throws a ValidationException with a formatted Error response.
     *
     * @throws ValidationException The exception is thrown to halt further processing and return validation errors.
     */
    protected function failedValidation(Validator $validator): never {
        $errors = $validator->errors()->toArray();

        // Remap 'handle' to 'username' if it exists
        if (isset($errors['handle'])) {
            $errors['username'] = $errors['handle'];
            unset($errors['handle']);
        }

        // Extract individual error arrays if they exist
        $firstNameErrors = $errors['first_name'] ?? null;
        $lastNameErrors  = $errors['last_name'] ?? null;
        $emailErrors     = $errors['email'] ?? null;
        $passwordErrors  = $errors['password'] ?? null;
        $usernameErrors  = $errors['username'] ?? null;

        // Choose a top-level error message
        if ($firstNameErrors) {
            $message = $firstNameErrors[0];
        } else if ($lastNameErrors) {
            $message = $lastNameErrors[0];
        } else if ($emailErrors) {
            $message = $emailErrors[0];
        } else if ($passwordErrors) {
            $message = $passwordErrors[0];
        } else if ($usernameErrors) {
            $message = $usernameErrors[0];
        } else {
            $message = 'Validation error';
        }

        // Build the API response
        $response = $this->error(
            422,
            $message,
            $errors,
        );

        throw new ValidationException($validator, $response);
    }
}
