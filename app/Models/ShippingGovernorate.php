<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingGovernorate extends Model
{

    public array $searchable = ['name'];
    public array $filterable = ['is_active', 'price'];
    public array $allowedFields = ['id', 'name', 'price', 'is_active', 'created_at', 'updated_at'];

    public function branches(): HasMany
    {
        return $this->hasMany(ShippingGovernorateBranch::class);
    }
}
