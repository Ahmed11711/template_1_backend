<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends BaseRequest
{
    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'name'     => ['sometimes', 'required', 'string', 'max:255'],
            'email'    => ['sometimes', 'required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'phone'    => ['sometimes', 'nullable', 'string', 'max:20'],
            'whtsapp'  => ['sometimes', 'nullable', 'string', 'max:20'],
            'avatar'   => ['sometimes', 'nullable', 'image',],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'الاسم مطلوب',
            'name.max'         => 'الاسم لا يتجاوز 255 حرفاً',
            'email.required'   => 'البريد الإلكتروني مطلوب',
            'email.email'      => 'البريد الإلكتروني غير صحيح',
            'email.unique'     => 'البريد الإلكتروني مستخدم بالفعل',
            'phone.max'        => 'رقم الهاتف لا يتجاوز 20 رقماً',
            'whtsapp.max'      => 'رقم الواتساب لا يتجاوز 20 رقماً',
            'avatar.image'     => 'الصورة يجب أن تكون ملف صورة',
            'avatar.mimes'     => 'الصورة يجب أن تكون jpg أو png أو webp',
            'avatar.max'       => 'حجم الصورة لا يتجاوز 2 ميجابايت',
        ];
    }
}
