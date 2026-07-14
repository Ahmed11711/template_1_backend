<?php

namespace App\Http\Controllers\Admin\ShippingGovernorate;

use App\Repositories\ShippingGovernorate\ShippingGovernorateRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\ShippingGovernorate\ShippingGovernorateStoreRequest;
use App\Http\Requests\Admin\ShippingGovernorate\ShippingGovernorateUpdateRequest;
use App\Http\Resources\Admin\ShippingGovernorate\ShippingGovernorateResource;

class ShippingGovernorateController extends BaseController
{
    public function __construct(ShippingGovernorateRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'ShippingGovernorate'
        );

        $this->storeRequestClass = ShippingGovernorateStoreRequest::class;
        $this->updateRequestClass = ShippingGovernorateUpdateRequest::class;
        $this->resourceClass = ShippingGovernorateResource::class;


        $this->withRelationships = ['branches'];
    }
}
