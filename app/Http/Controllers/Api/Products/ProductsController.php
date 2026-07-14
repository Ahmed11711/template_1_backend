<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Models\HomeSection;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $sections = HomeSection::with(['products' => function ($query) {
            $query->where('is_active', true)
                ->with(['primaryImage', 'firstImage'])
                ->orderBy('home_section_products.sort_order');
        }])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $sections->each(function ($section) {
            $section->products->each(function ($product) {
                $product->thumbnail = $product->primaryImage ?? $product->firstImage;
                unset($product->primaryImage, $product->firstImage);
            });
        });

        return $this->successResponse($sections, "list-of-products");
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)

            ->with(['gallery', 'category', 'primaryImage', 'variants', 'reviews.user:id,name,email,avatar'])
            ->first();

        if (!$product) {
            return $this->errorResponse("not have the products");
        }


        return $this->successResponse(new ProductResource($product), "product-details");
    }
}
