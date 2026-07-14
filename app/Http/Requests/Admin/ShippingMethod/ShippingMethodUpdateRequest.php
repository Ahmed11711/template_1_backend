<?php

namespace App\Http\Requests\Admin\ShippingMethod;

use App\Http\Requests\BaseRequest\BaseRequest;

class ShippingMethodUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:free,flat,percentage,governorate',
            'flat_rate' => 'sometimes|nullable|numeric',
            'percentage_value' => 'sometimes|nullable|numeric',
            'is_active' => 'sometimes|required|integer',
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
