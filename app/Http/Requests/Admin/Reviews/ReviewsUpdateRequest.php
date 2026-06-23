<?php

namespace App\Http\Requests\Admin\Reviews;

use App\Http\Requests\BaseRequest\BaseRequest;

class ReviewsUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'sometimes|nullable|exists:products,id|display_field:name',
            'user_id' => 'sometimes|nullable|exists:users,id|display_field:name',
            'guest_name' => 'sometimes|nullable|string|max:255',
            'rating' => 'sometimes|required|integer',
            'comment' => 'sometimes|required|string',
            'is_approved' => 'sometimes|required|integer',
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
            'is_approved.required' => 'The is approved field is required.',
        ];
    }
}
