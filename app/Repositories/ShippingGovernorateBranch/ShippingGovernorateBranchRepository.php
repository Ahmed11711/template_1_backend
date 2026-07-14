<?php

namespace App\Repositories\ShippingGovernorateBranch;

use App\Repositories\ShippingGovernorateBranch\ShippingGovernorateBranchRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\ShippingGovernorateBranch;

/**
 * Class ShippingGovernorateBranchRepository
 * @package App\Repositories\ShippingGovernorateBranch
 */
class ShippingGovernorateBranchRepository extends BaseRepository implements ShippingGovernorateBranchRepositoryInterface
{
    /**
     * ShippingGovernorateBranchRepository constructor.
     *
     * @param ShippingGovernorateBranch $model
     */
    public function __construct(ShippingGovernorateBranch $model)
    {
        parent::__construct($model);
    }
}