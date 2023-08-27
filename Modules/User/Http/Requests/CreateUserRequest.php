<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required", "string", "min:3"],
            "email" => ["required", "string", "email", "unique:users,email"],
            "password" => ["required", "string", "min:6", "required_with:password_confirmation", "same:password_confirmation"],
            "password_confirmation" => ["required", "string", "min:6"]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
