<?php

namespace App\Http\Requests\Admin\ShippingGovernorate;

use App\Http\Requests\BaseRequest\BaseRequest;

class ShippingGovernorateStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'is_active' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'price.required' => 'The price field is required.',
            'is_active.required' => 'The is active field is required.',
        ];
    }
}
