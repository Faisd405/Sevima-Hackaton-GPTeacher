<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'userData.name' => 'required|string|max:255',
            'userData.username' => 'required|string|max:255|unique:users,username',
            'userData.email' => 'required|email|max:255|unique:users,email',
            'userData.password' => 'required|string|min:8',

            // Profile
            'userData.profile.phone' => 'nullable|string|max:255',
            'userData.profile.address' => 'nullable|string|max:255',

            // Role
            'userData.role' => 'required|string|exists:roles,name',
        ];
    }
}
