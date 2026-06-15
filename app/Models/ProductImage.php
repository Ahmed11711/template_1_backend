<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected function casts(): array
    {
        return [
            'image' => ImageCast::class,
        ];
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
