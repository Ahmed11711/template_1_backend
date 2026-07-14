<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Repositories\Coupon\CouponRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Coupon\CouponStoreRequest;
use App\Http\Requests\Admin\Coupon\CouponUpdateRequest;
use App\Http\Resources\Admin\Coupon\CouponResource;

class CouponController extends BaseController
{
    public function __construct(CouponRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Coupon'
        );

        $this->storeRequestClass = CouponStoreRequest::class;
        $this->updateRequestClass = CouponUpdateRequest::class;
        $this->resourceClass = CouponResource::class;
    }
}
