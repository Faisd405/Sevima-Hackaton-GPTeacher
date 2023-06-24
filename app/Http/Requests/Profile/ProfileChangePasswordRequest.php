<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileChangePasswordRequest extends FormRequest
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
            'changePasswordForm.current_password' => ['required', 'string'],
            'changePasswordForm.password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'changePasswordForm.current_password' => 'current password',
            'changePasswordForm.password' => 'password',
            'changePasswordForm.password_confirmation' => 'password confirmation',
        ];
    }
}
