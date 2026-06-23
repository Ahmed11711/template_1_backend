<?php

namespace App\Http\Resources\Admin\Reviews;

use App\Http\Resources\Admin\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Reviews
 */
class ReviewsResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['product_id', 'user_id', 'guest_name', 'rating', 'comment', 'emoji', 'is_approved', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }

        $data['user'] = new UserResource($this->whenLoaded('user'));


        return $data;
    }
}
