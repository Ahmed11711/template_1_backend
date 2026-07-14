<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{

    public array $searchable = ['comment'];
    public array $filterable = ['product_id', 'user_id', 'rating', 'is_approved'];
    public array $allowedFields = ['id', 'product_id', 'user_id', 'guest_name', 'rating', 'comment', 'emoji', 'is_approved', 'created_at', 'updated_at'];

    //

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
