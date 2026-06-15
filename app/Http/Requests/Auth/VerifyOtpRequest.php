<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class VerifyOtpRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $context = $this->route('context');

        return [
            'identifier' => 'required|string',
            'otp'        => 'required|numeric|digits:6',

            'password'   => [
                $context === 'forget_password' ? 'required' : 'nullable',
                'string',
                'min:8',
            ],
        ];
    }

    /**
     * Custom messages for validation
     */
    public function messages(): array
    {
        return [
            'identifier.required' => 'The email or phone field is required.',
            'otp.required'        => 'The verification code is required.',
            'otp.digits'          => 'The verification code must be exactly 6 digits.',
            'password.required'   => 'A new password is required to reset your account.',
            'password.confirmed'  => 'The password confirmation does not match.',
            'password.min'        => 'The password must be at least 8 characters.',
        ];
    }
}
