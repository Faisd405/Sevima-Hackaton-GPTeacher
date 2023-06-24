<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules($userId): array
    {
        return [
            'userData.name' => 'required|string|max:255',
            'userData.username' => 'required|string|max:255|unique:users,username,' . $userId,
            'userData.email' => 'required|email|max:255|unique:users,email,' . $userId,
            'userData.password' => 'nullable|string|min:8',

            // Profile
            'userData.profile.phone' => 'nullable|string|max:255',
            'userData.profile.address' => 'nullable|string|max:255',

            // Role
            'userData.role' => 'required|string|exists:roles,name',
        ];
    }
}
