<?php

namespace App\Repositories\ShippingGovernorate;

use App\Repositories\ShippingGovernorate\ShippingGovernorateRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\ShippingGovernorate;

/**
 * Class ShippingGovernorateRepository
 * @package App\Repositories\ShippingGovernorate
 */
class ShippingGovernorateRepository extends BaseRepository implements ShippingGovernorateRepositoryInterface
{
    /**
     * ShippingGovernorateRepository constructor.
     *
     * @param ShippingGovernorate $model
     */
    public function __construct(ShippingGovernorate $model)
    {
        parent::__construct($model);
    }

    public function AllActive()
    {
        return $this->model
            ->where('is_active', true)
            ->with('branches')
            ->get();
    }
}
