<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public array $searchable = ['short_description'];
    public array $filterable = ['category_id', 'track_stock', 'is_active', 'is_featured'];
    public array $allowedFields = ['id', 'category_id', 'name', 'slug', 'short_description', 'description', 'sku', 'price', 'compare_price', 'cost_price', 'track_stock', 'stock_quantity', 'low_stock_threshold', 'is_active', 'is_featured', 'sort_order', 'meta_title', 'meta_description', 'views_count', 'average_rating', 'reviews_count', 'created_at', 'updated_at'];
    protected function casts(): array
    {
        return [
            'image' => ImageCast::class,
        ];
    }

    public function sections()
    {
        return $this->belongsToMany(HomeSection::class, 'home_section_products', 'product_id', 'section_id')
            ->withPivot('sort_order');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function gallery()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true)->latest();
    }

    public function firstImage()
    {
        return $this->hasOne(ProductImage::class)->oldestOfMany();
    }

    // App\Models\Product.php


}
