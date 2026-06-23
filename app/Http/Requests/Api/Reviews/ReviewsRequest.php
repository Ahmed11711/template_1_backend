<?php

namespace App\Http\Requests\Api\Reviews;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewsRequest extends BaseRequest
{

    public function rules(): array
    {
        if ($this->isMethod('POST')) {
            return [
                'product_id' => ['required', 'integer', 'exists:products,id'],
                'rating'     => ['required', 'integer', 'min:1', 'max:5'],
                'comment'    => ['required', 'string', 'min:1', 'max:500'],
                'emoji'      => ['nullable', 'string', 'max:10'],
            ];
        }

        return [
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:3', 'max:500'],
            'emoji'   => ['nullable', 'string', 'max:10'],
        ];
    }
}
