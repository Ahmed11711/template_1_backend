<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Product
 */
class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        $attributes = $this->resource->getAttributes();
        $data = ['id' => $this->id];

        $fields = [
            'category_id',
            'name',
            'slug',
            'short_description',
            'description',
            'sku',
            'price',
            'compare_price',
            'cost_price',
            'track_stock',
            'stock_quantity',
            'low_stock_threshold',
            'is_active',
            'is_featured',
            'sort_order',
            'meta_title',
            'meta_description',
            'views_count',
            'average_rating',
            'reviews_count',
            'created_at',
            'updated_at',
        ];

        foreach ($fields as $field) {
            if (array_key_exists($field, $attributes)) {
                $data[$field] = $this->{$field};
            }
        }

        // Computed
        $data['is_low_stock'] = $this->is_low_stock;
        $data['is_in_stock']  = $this->is_in_stock;

        // Relations
        $data['category'] = $this->whenLoaded('category', fn() => [
            'id'   => $this->category->id,
            'name' => $this->category->name,
            'slug' => $this->category->slug,
        ]);

        $data['images'] = ProductImageResource::collection($this->whenLoaded('images'));
        $data['gallery'] = ProductImageResource::collection($this->whenLoaded('gallery'));
        $data['variants'] = ProductVariantResource::collection($this->whenLoaded('variants'));

        return $data;
    }
}
