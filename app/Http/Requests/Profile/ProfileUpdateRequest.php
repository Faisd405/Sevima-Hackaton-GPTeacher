<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'userForm.name' => ['required', 'string', 'max:255'],
            'userForm.username' => ['required', 'string', 'max:255'],
            'userForm.email' => ['required', 'string', 'email', 'max:255'],
            'userForm.password' => ['nullable', 'string', 'min:8', 'confirmed'],

            // Profile
            'userForm.profile.phone' => ['nullable', 'string', 'max:255'],
            'userForm.profile.address' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'userForm.name' => 'name',
            'userForm.username' => 'username',
            'userForm.email' => 'email',
            'userForm.password' => 'password',
            'userForm.password_confirmation' => 'password confirmation',
            'userForm.profile.image' => 'image',
            'userForm.profile.phone' => 'phone',
            'userForm.profile.address' => 'address',
        ];
    }
}
