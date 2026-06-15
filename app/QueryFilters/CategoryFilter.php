<?php

namespace App\QueryFilters;

use Closure;

class CategoryFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('category_id') || !request()->category_id) {
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('categories', function ($q) {
            $q->where('categories.id', request('category_id'));
        });
    }
}
