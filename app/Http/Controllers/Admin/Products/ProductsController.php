<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Http\Requests\Admin\Products\ProductsUpdateRequest;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Http\Resources\Admin\Products\ProductsResource;
use App\Repositories\Products\ProductsRepositoryInterface;
use Illuminate\Http\Request;

class ProductsController extends BaseController
{
    public function __construct(ProductsRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Products'
        );

        $this->storeRequestClass = ProductStoreRequest::class;
        $this->updateRequestClass = ProductUpdateRequest::class;
        $this->resourceClass = ProductResource::class;
        // Enables BaseController::uploadGalleryFiles() via Product::gallery()
        $this->hasGallery = true;

        // Eager-load relations for index/show
        $this->withRelationships = ['category', 'images', 'variants'];
    }

    /**
     * Remove variants payload before creating the product
     * (variants are created separately after the product exists).
     */
    protected function beforeStore(array $data, Request $request): array
    {
        unset($data['variants'], $data['gallery'], $data['sections']); // ✅ أضف sections
        return $data;
    }

    /**
     * Sync variants after the product is created.
     */
    protected function afterStore($record, Request $request): void
    {
        $this->syncVariants($record, $request);
        $this->syncSections($record, $request); // ✅
    }

    /**
     * Remove variants payload before updating the product.
     */
    protected function beforeUpdate(array $data, $existingRecord, Request $request): array
    {
        unset($data['variants'], $data['gallery'], $data['sections']); // ✅
        return $data;
    }

    /**
     * Sync variants after the product is updated.
     */
    protected function afterUpdate($updatedRecord, $oldRecord, Request $request): void
    {
        $this->syncVariants($updatedRecord, $request);
        $this->syncSections($updatedRecord, $request); // ✅
    }

    protected function syncSections($product, Request $request): void
    {
        if (!$request->has('sections')) {
            return;
        }

        // sections = [1, 2, 3]
        $product->sections()->sync($request->input('sections', []));
    }
    /**
     * Create / update / remove variants based on the incoming payload.
     *
     * - Variant with 'id' present  => update existing
     * - Variant without 'id'       => create new
     * - Existing variants not present in payload => deleted
     */
    protected function syncVariants($product, Request $request): void
    {
        if (!$request->has('variants')) {
            return;
        }

        $incoming = collect($request->input('variants', []));
        $keepIds = [];

        foreach ($incoming as $variantData) {
            $variantData['product_id'] = $product->id;

            if (!empty($variantData['id'])) {
                $variant = $product->variants()->find($variantData['id']);
                if ($variant) {
                    $variant->update($variantData);
                    $keepIds[] = $variant->id;
                    continue;
                }
            }

            $variant = $product->variants()->create($variantData);
            $keepIds[] = $variant->id;
        }

        // Delete variants removed by the admin
        $product->variants()->whereNotIn('id', $keepIds)->delete();
    }
}
