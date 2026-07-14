<?php

namespace App\Http\Requests\Admin\Coupon;

use App\Http\Requests\BaseRequest\BaseRequest;

class CouponStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric',
            'min_order_amount' => 'nullable|numeric',
            'max_uses' => 'nullable|integer',
            'used_count' => 'nullable|integer',
            'expires_at' => 'nullable|date',
            'is_active' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The code field is required.',
            'code.max' => 'The code may not be greater than 255 characters.',
            'code.unique' => 'This code has already been taken.',
            'type.required' => 'The type field is required.',
            'value.required' => 'The value field is required.',
            'min_order_amount.required' => 'The min order amount field is required.',
            'used_count.required' => 'The used count field is required.',
            'expires_at.date' => 'The expires at is not a valid date.',
            'is_active.required' => 'The is active field is required.',
        ];
    }
}
