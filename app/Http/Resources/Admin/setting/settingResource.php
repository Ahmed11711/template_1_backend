<?php

namespace App\Http\Resources\Admin\setting;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\setting
 */
class settingResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['key', 'value', 'type', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }

        return $data;
    }
}