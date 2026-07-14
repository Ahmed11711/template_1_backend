<?php

namespace App\Repositories\Coupon;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

/**
 * Interface CouponRepositoryInterface
 * @package App\Repositories\Coupon
 */
interface CouponRepositoryInterface extends BaseRepositoryInterface
{
    public function allActive();
    public function findByCode(string $code);
}
