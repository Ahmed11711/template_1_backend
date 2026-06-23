<?php

namespace App\Http\Requests\Admin\Pages;

use App\Http\Requests\BaseRequest\BaseRequest;

class PagesUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:pages,slug,'.$this->route('pages').',id',
            'status' => 'sometimes|required|string|max:255',
            'is_active' => 'sometimes|required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'slug.required' => 'The slug field is required.',
            'slug.max' => 'The slug may not be greater than 255 characters.',
            'slug.unique' => 'This slug has already been taken.',
            'status.required' => 'The status field is required.',
            'status.max' => 'The status may not be greater than 255 characters.',
            'is_active.required' => 'The is active field is required.',
        ];
    }
}
