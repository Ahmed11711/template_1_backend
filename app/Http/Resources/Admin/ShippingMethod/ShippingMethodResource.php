<?php

namespace App\Http\Resources\Admin\ShippingMethod;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\ShippingMethod
 */
class ShippingMethodResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['name', 'type', 'flat_rate', 'percentage_value', 'is_active', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }

        return $data;
    }
}