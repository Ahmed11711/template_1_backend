<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{

    public array $searchable = ['name'];
    public array $filterable = ['type', 'is_active'];
    public array $allowedFields = ['id', 'name', 'type', 'flat_rate', 'percentage_value', 'is_active', 'created_at', 'updated_at'];

    //
}
