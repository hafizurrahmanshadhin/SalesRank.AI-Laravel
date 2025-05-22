<?php

namespace App\Http\Requests\Api\User;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StorePortfolioProjectRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        // Only sales professionals can create portfolios
        return $this->user() && $this->user()->role === 'sales_professional';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'project_file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:20480',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array {
        return [
            'project_file.required' => 'A project file is required.',
            'project_file.file'     => 'The uploaded file is not valid.',
            'project_file.mimes'    => 'The file must be a PDF, Word document, or image file.',
            'project_file.max'      => 'The file size cannot exceed 20MB.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator): void {
        $response = Helper::jsonResponse(false, 'Validation failed', 422, ['errors' => $validator->errors()], 422);

        throw new ValidationException($validator, $response);
    }
}
