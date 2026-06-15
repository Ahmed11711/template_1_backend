<?php

namespace App\Http\Requests\Admin\HomeSection;

use App\Http\Requests\BaseRequest\BaseRequest;

class HomeSectionUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'color' => 'sometimes|nullable|string|max:7',
            'sort_order' => 'sometimes|required|integer',
            'is_active' => 'sometimes|required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'color.max' => 'The color may not be greater than 7 characters.',
            'sort_order.required' => 'The sort order field is required.',
            'is_active.required' => 'The is active field is required.',
        ];
    }
}
