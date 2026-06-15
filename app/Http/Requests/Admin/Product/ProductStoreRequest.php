<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'category_id'         => ['required', 'integer', 'exists:categories,id'],

            // Basic Info
            'name'                => ['required', 'string', 'max:255'],
            'slug'                => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'short_description'   => ['nullable', 'string'],
            'description'         => ['nullable', 'string'],
            'sku'                 => ['nullable', 'string', 'max:100', 'unique:products,sku'],

            // Pricing
            'price'               => ['required', 'numeric', 'min:0'],
            'compare_price'       => ['nullable', 'numeric', 'min:0', 'gte:price'],
            'cost_price'          => ['nullable', 'numeric', 'min:0'],

            // Stock
            'track_stock'         => ['nullable', 'boolean'],
            'stock_quantity'      => ['nullable', 'integer', 'min:0'],
            'low_stock_threshold' => ['nullable', 'integer', 'min:0'],

            // Display
            'is_active'           => ['nullable', 'boolean'],
            'is_featured'         => ['nullable', 'boolean'],
            'sort_order'          => ['nullable', 'integer', 'min:0'],

            // SEO
            'meta_title'          => ['nullable', 'string', 'max:255'],
            'meta_description'    => ['nullable', 'string', 'max:500'],

            // Images (gallery)
            'gallery'             => ['nullable', 'array'],
            'gallery.*'           => ['file', 'image', 'max:4096'],

            // Variants
            'variants'                    => ['nullable', 'array'],
            'variants.*.sku'              => ['nullable', 'string', 'max:100', 'distinct', 'unique:product_variants,sku'],
            'variants.*.color'            => ['nullable', 'string', 'max:100'],
            'variants.*.storage'          => ['nullable', 'string', 'max:100'],
            'variants.*.size'             => ['nullable', 'string', 'max:100'],
            'variants.*.price_adjustment' => ['nullable', 'numeric'],
            'variants.*.stock'            => ['nullable', 'integer', 'min:0'],
            'variants.*.is_active'        => ['nullable', 'boolean'],

            'sections'   => ['nullable', 'array'],
            'sections.*' => ['integer', 'exists:home_sections,id'],
        ];
    }
}
