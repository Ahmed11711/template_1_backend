<?php

namespace App\Http\Resources\Admin\PaymentGateway;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\PaymentGateway
 */
class PaymentGatewayResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['name', 'value', 'requires_receipt', 'is_active', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }
        $data['image'] = $this->image ? asset($this->image) : null;

        return $data;
    }
}