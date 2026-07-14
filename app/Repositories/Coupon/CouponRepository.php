<?php

namespace App\Repositories\Coupon;

use App\Repositories\Coupon\CouponRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Coupon;

/**
 * Class CouponRepository
 * @package App\Repositories\Coupon
 */
class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{
    /**
     * CouponRepository constructor.
     *
     * @param Coupon $model
     */
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }
    public function allActive()
    {
        return $this->model
            ->where('is_active', 1)
            ->get();
    }
    public function findByCode(string $code)
    {
        return $this->model::where('code', $code)->first();
    }
}
