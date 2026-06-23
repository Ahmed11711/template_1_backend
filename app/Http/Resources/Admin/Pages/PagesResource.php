<?php

namespace App\Http\Resources\Admin\Pages;

use App\Http\Resources\Admin\Section\SectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Pages
 */
class PagesResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['title', 'slug', 'status', 'is_active', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }

        $data['sections'] = SectionResource::collection($this->whenLoaded('sections'));
        return $data;
    }
}
