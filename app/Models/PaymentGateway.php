<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{

    public array $searchable = [''];
    public array $filterable = ['requires_receipt', 'is_active'];
    public array $allowedFields = ['id', 'name', 'image', 'value', 'requires_receipt', 'is_active', 'created_at', 'updated_at'];

    //
}
