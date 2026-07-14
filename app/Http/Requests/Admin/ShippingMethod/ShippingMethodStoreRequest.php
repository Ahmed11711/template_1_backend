<?php

namespace App\Http\Requests\Admin\ShippingMethod;

use App\Http\Requests\BaseRequest\BaseRequest;

class ShippingMethodStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,flat,percentage,governorate',
            'flat_rate' => 'nullable|numeric',
            'percentage_value' => 'nullable|numeric',
            'is_active' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'type.required' => 'The type field is required.',
            'is_active.required' => 'The is active field is required.',
        ];
    }
}
