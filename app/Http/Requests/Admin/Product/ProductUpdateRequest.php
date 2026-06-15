<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product') ?? $this->route('id');

        return [
            'category_id'         => ['sometimes', 'required', 'integer', 'exists:categories,id'],

            // Basic Info
            'name'                => ['sometimes', 'required', 'string', 'max:255'],
            'slug'                => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'short_description'   => ['nullable', 'string'],
            'description'         => ['nullable', 'string'],
            'sku'                 => ['nullable', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($productId)],

            // Pricing
            'price'               => ['sometimes', 'required', 'numeric', 'min:0'],
            'compare_price'       => ['nullable', 'numeric', 'min:0'],
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
            'variants.*.id'               => ['nullable', 'integer', 'exists:product_variants,id'],
            'variants.*.sku'              => ['nullable', 'string', 'max:100'],
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
