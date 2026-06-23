<?php

namespace App\Http\Requests\Admin\Section;

use App\Http\Requests\BaseRequest\BaseRequest;

class SectionStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page_id' => 'required|exists:pages,id|display_field:title',
            'type' => 'required|string|max:255',
            'order' => 'required|integer',
            'props' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'page_id.required' => 'The page id field is required.',
            'page_id.exists' => 'The selected page id is invalid.',
            'type.required' => 'The type field is required.',
            'type.max' => 'The type may not be greater than 255 characters.',
            'order.required' => 'The order field is required.',
            'props.required' => 'The props field is required.',
        ];
    }
}
