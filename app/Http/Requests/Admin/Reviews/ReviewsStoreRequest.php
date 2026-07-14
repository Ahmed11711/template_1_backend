<?php

namespace App\Http\Requests\Admin\Reviews;

use App\Http\Requests\BaseRequest\BaseRequest;

class ReviewsStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'nullable|exists:products,id|display_field:name',
            'user_id' => 'nullable|exists:users,id|display_field:name',
            'guest_name' => 'nullable|string|max:255',
            'rating' => 'required|integer',
            'comment' => 'required|string',
            'emoji' => 'nullable|string|max:50',
            'is_approved' => 'required|integer',
            'admin_reply' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.exists' => 'The selected product id is invalid.',
            'user_id.exists' => 'The selected user id is invalid.',
            'guest_name.max' => 'The guest name may not be greater than 255 characters.',
            'rating.required' => 'The rating field is required.',
            'comment.required' => 'The comment field is required.',
            'emoji.max' => 'The emoji may not be greater than 50 characters.',
            'is_approved.required' => 'The is approved field is required.',
        ];
    }
}
