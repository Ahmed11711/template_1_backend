<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    public array $searchable = ['name'];
    public array $filterable = ['is_featured', 'is_active'];
    public array $allowedFields = ['id', 'name', 'slug', 'description', 'is_featured', 'image', 'sort_order', 'is_active', 'meta_title', 'meta_description', 'promotional_text', 'created_at', 'updated_at'];

    protected function casts(): array
    {
        return [
            'image' => ImageCast::class,
        ];
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
