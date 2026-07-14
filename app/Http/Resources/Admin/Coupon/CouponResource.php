<?php

namespace App\Http\Resources\Admin\Coupon;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Coupon
 */
class CouponResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['code', 'type', 'value', 'min_order_amount', 'max_uses', 'used_count', 'expires_at', 'is_active', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }

        return $data;
    }
}