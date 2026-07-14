<?php

namespace App\Http\Controllers\Admin\ShippingMethod;

use App\Repositories\ShippingMethod\ShippingMethodRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\ShippingMethod\ShippingMethodStoreRequest;
use App\Http\Requests\Admin\ShippingMethod\ShippingMethodUpdateRequest;
use App\Http\Resources\Admin\ShippingMethod\ShippingMethodResource;

class ShippingMethodController extends BaseController
{
    public function __construct(ShippingMethodRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'ShippingMethod'
        );

        $this->storeRequestClass = ShippingMethodStoreRequest::class;
        $this->updateRequestClass = ShippingMethodUpdateRequest::class;
        $this->resourceClass = ShippingMethodResource::class;
    }
}
