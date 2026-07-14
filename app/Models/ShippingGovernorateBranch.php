<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingGovernorateBranch extends Model
{

    public array $searchable = [''];
    public array $filterable = ['shipping_governorate_id', 'is_active'];
    public array $allowedFields = ['id', 'shipping_governorate_id', 'name', 'price', 'is_active', 'created_at', 'updated_at'];

    //

    public function shippingGovernorate()
    {
        return $this->belongsTo(ShippingGovernorate::class, 'shipping_governorate_id');
    }

}