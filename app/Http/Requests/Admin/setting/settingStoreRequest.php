<?php

namespace App\Http\Requests\Admin\setting;

use App\Http\Requests\BaseRequest\BaseRequest;

class settingStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'key.required' => 'The key field is required.',
            'key.max' => 'The key may not be greater than 255 characters.',
            'value.required' => 'The value field is required.',
            'value.max' => 'The value may not be greater than 255 characters.',
            'type.required' => 'The type field is required.',
            'type.max' => 'The type may not be greater than 255 characters.',
        ];
    }
}
