<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{

    public array $searchable = [''];
    public array $filterable = ['is_active'];
    public array $allowedFields = ['id', 'title', 'slug', 'status', 'is_active', 'created_at', 'updated_at'];

    public function sections()
    {
        return $this->hasMany(Section::class, 'page_id')->orderBy('order');
    }
}
