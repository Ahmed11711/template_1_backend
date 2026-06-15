<?php

namespace App\Repositories\Categories;

use App\Repositories\Categories\CategoriesRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Categories;

/**
 * Class CategoriesRepository
 * @package App\Repositories\Categories
 */
class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    /**
     * CategoriesRepository constructor.
     *
     * @param Categories $model
     */
    public function __construct(Categories $model)
    {
        parent::__construct($model);
    }
}