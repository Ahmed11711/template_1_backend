<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $categories = Categories::with([
            'products' => function ($query) {
                $query->where('is_active', true)
                    ->with(['primaryImage', 'firstImage']);
            }
        ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $categories->each(function ($category) {
            $category->products->each(function ($product) {
                $product->thumbnail = $product->primaryImage ?? $product->firstImage;
                unset($product->primaryImage, $product->firstImage);
            });
        });

        return $this->successResponse($categories, 'list-of-categories');
    }
}
