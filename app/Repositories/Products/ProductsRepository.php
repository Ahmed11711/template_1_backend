<?php

namespace App\Repositories\Products;

use App\Models\Product;
use App\Repositories\BaseRepository\BaseRepository;
use App\Repositories\Products\ProductsRepositoryInterface;

/**
 * Class ProductsRepository
 * @package App\Repositories\Products
 */
class ProductsRepository extends BaseRepository implements ProductsRepositoryInterface
{
    /**
     * ProductsRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
