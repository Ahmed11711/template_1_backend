<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{

    public $searchable = ['page_id', 'id'];
    public $filterable = ['page_id'];

    protected $casts = [
        'props' => 'array',
    ];
    public function pages()
    {
        return $this->belongsTo(Pages::class, 'page_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SectionItems::class, 'section_id');
    }
}
