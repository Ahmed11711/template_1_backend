<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\ProductVariant
 */
class ProductVariantResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'sku'              => $this->sku,
            'color'            => $this->color,
            'storage'          => $this->storage,
            'size'             => $this->size,
            'price_adjustment' => (float) $this->price_adjustment,
            'final_price'      => $this->whenLoaded('product', fn () => $this->final_price),
            'stock'            => $this->stock,
            'is_active'        => (bool) $this->is_active,
        ];
    }
}
