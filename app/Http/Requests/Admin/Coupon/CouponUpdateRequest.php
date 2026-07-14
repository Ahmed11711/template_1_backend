<?php

namespace App\Http\Requests\Admin\Coupon;

use App\Http\Requests\BaseRequest\BaseRequest;

class CouponUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|max:255|unique:coupons,code,'.$this->route('coupon').',id',
            'type' => 'sometimes|required|in:percentage,fixed',
            'value' => 'sometimes|required|numeric',
            'min_order_amount' => 'sometimes|required|numeric',
            'max_uses' => 'sometimes|nullable|integer',
            'used_count' => 'sometimes|required|integer',
            'expires_at' => 'sometimes|nullable|date',
            'is_active' => 'sometimes|required|integer',
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
