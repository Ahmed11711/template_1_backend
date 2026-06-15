<?php

namespace App\Http\Requests\Admin\Categories;

use App\Http\Requests\BaseRequest\BaseRequest;

class CategoriesStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'is_featured' => 'required|integer',
            'image' => 'nullable|file|image|max:2048',
            'sort_order' => 'required|integer',
            'is_active' => 'required|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'promotional_text' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'slug.required' => 'The slug field is required.',
            'slug.max' => 'The slug may not be greater than 255 characters.',
            'slug.unique' => 'This slug has already been taken.',
            'is_featured.required' => 'The is featured field is required.',
            'image.image' => 'The image must be a valid image file.',
            'image.max' => 'The image may not be greater than 2048 KB.',
            'sort_order.required' => 'The sort order field is required.',
            'is_active.required' => 'The is active field is required.',
            'meta_title.max' => 'The meta title may not be greater than 255 characters.',
            'meta_description.max' => 'The meta description may not be greater than 255 characters.',
            'promotional_text.max' => 'The promotional text may not be greater than 255 characters.',
        ];
    }
}
