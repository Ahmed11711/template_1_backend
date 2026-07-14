<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }
}
