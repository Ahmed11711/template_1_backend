<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{

    public array $searchable = [''];
    public array $filterable = ['is_active'];
    public array $allowedFields = ['id', 'title', 'color', 'sort_order', 'is_active', 'created_at', 'updated_at'];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'home_section_products', 'section_id', 'product_id')
            ->withPivot('sort_order');
    }
}
