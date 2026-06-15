<?php

namespace App\Http\Resources\Admin\Categories;

use App\Http\Resources\Admin\Product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Categories
 */
class CategoriesResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];
        $fields = ['name', 'slug', 'description', 'is_featured', 'sort_order', 'is_active', 'meta_title', 'meta_description', 'promotional_text', 'created_at', 'updated_at'];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }
        $data['image'] = $this->image ? asset($this->image) : null;
        $data['products'] = $this->whenLoaded('products', function () {
            return ProductResource::collection($this->products);
        });
        return $data;
    }
}
