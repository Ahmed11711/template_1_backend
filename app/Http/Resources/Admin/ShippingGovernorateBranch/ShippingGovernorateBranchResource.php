<?php

namespace App\Http\Resources\Admin\ShippingGovernorateBranch;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\ShippingGovernorateBranch
 */
class ShippingGovernorateBranchResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['shipping_governorate_id', 'name', 'price', 'is_active', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }

        return $data;
    }
}