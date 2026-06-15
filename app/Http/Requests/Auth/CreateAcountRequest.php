<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateAcountRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required_without:phone|nullable|email|unique:users,email',
            'phone'    => [
                'required_without:email',
                'nullable',
                'string',
                'unique:users,phone',
                'regex:/^[0-9]{8,15}$/'
            ],
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'             => 'The name field is required.',
            'name.string'               => 'The name must be a valid string.',
            'name.max'                  => 'The name may not be greater than 255 characters.',

            'email.required_without'    => 'The email field is required when phone is not present.',
            'email.email'               => 'Please enter a valid email address.',
            'email.unique'              => 'This email is already registered.',

            'phone.required_without'    => 'The phone field is required when email is not present.',
            'phone.unique'              => 'This phone number is already registered.',
            'phone.regex' => 'The phone number must contain only digits and be between 8 to 15 characters long.',
            'phone.unique' => 'This phone number is already registered.',
            'phone.required_without' => 'The phone field is required when email is not present.',
        ];
    }
}
