<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class setting extends Model
{

    public array $searchable = [''];
    public array $filterable = [''];
    public array $allowedFields = ['id', 'key', 'value', 'type', 'created_at', 'updated_at'];

    //
}
