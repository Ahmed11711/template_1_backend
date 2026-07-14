<?php

namespace App\Http\Requests\Admin\ShippingGovernorateBranch;

use App\Http\Requests\BaseRequest\BaseRequest;

class ShippingGovernorateBranchStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipping_governorate_id' => 'required|exists:shipping_governorates,id|display_field:name',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'is_active' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_governorate_id.required' => 'The shipping governorate id field is required.',
            'shipping_governorate_id.exists' => 'The selected shipping governorate id is invalid.',
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'price.required' => 'The price field is required.',
            'is_active.required' => 'The is active field is required.',
        ];
    }
}
