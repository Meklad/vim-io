<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "code" => ["required", "numeric", "digits_between:4,4"]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Custom Validation Messages.
     */
    public function messages(): array
    {
        return [
            "code.digits_between" => "The code field must be 4 digits."
        ];
    }
}
