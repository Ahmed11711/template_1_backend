<?php

namespace App\Repositories\ShippingMethod;

use App\Repositories\ShippingMethod\ShippingMethodRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\ShippingMethod;

/**
 * Class ShippingMethodRepository
 * @package App\Repositories\ShippingMethod
 */
class ShippingMethodRepository extends BaseRepository implements ShippingMethodRepositoryInterface
{
    /**
     * ShippingMethodRepository constructor.
     *
     * @param ShippingMethod $model
     */
    public function __construct(ShippingMethod $model)
    {
        parent::__construct($model);
    }
}