<?php

namespace App\Http\Requests\Admin\PaymentGateway;

use App\Http\Requests\BaseRequest\BaseRequest;

class PaymentGatewayStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'nullable|file|image|max:2048',
            'value' => 'nullable|string|max:255',
            'requires_receipt' => 'required|integer',
            'is_active' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'image.image' => 'The image must be a valid image file.',
            'image.max' => 'The image may not be greater than 2048 KB.',
            'value.max' => 'The value may not be greater than 255 characters.',
            'requires_receipt.required' => 'The requires receipt field is required.',
            'is_active.required' => 'The is active field is required.',
        ];
    }
}
