<?php

namespace App\Repositories\ShippingGovernorate;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

/**
 * Interface ShippingGovernorateRepositoryInterface
 * @package App\Repositories\ShippingGovernorate
 */
interface ShippingGovernorateRepositoryInterface extends BaseRepositoryInterface
{
    public function AllActive();
}
