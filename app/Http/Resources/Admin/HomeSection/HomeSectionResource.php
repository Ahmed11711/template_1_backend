<?php

namespace App\Http\Resources\Admin\HomeSection;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\HomeSection
 */
class HomeSectionResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['title', 'color', 'sort_order', 'is_active', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }

        return $data;
    }
}