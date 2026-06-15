<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    /**
     */
    public function getFinalPriceAttribute(): float
    {
        return (float) ($this->product->base_price + $this->price_adjustment);
    }

    /**
     */
    public function getInStockAttribute(): bool
    {
        return $this->stock > 0;
    }
}
