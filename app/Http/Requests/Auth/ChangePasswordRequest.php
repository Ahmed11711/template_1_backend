<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'current_password'      => ['required', 'string'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required'      => 'كلمة المرور الحالية مطلوبة',
            'password.required'              => 'كلمة المرور الجديدة مطلوبة',
            'password.min'                   => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed'             => 'كلمة المرور غير متطابقة',
            'password_confirmation.required' => 'تأكيد كلمة المرور مطلوب',
        ];
    }
}
