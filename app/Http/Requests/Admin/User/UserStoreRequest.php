<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseRequest\BaseRequest;

class UserStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'avatar' => 'nullable|file|image',
            'role' => 'required|in:admin,customer',
            'is_active' => 'required|integer',
            'email_verified_at' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'email.unique' => 'This email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.max' => 'The password may not be greater than 255 characters.',
            'phone.max' => 'The phone may not be greater than 255 characters.',
            'avatar.image' => 'The avatar must be a valid image file.',
            'avatar.max' => 'The avatar may not be greater than 2048 KB.',
            'role.required' => 'The role field is required.',
            'role.max' => 'The role may not be greater than 255 characters.',
            'is_active.required' => 'The is active field is required.',
            'email_verified_at.date' => 'The email verified at is not a valid date.',
            'remember_token.max' => 'The remember token may not be greater than 100 characters.',
        ];
    }
}
