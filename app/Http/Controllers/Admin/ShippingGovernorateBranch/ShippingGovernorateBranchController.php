<?php

namespace App\Http\Controllers\Admin\ShippingGovernorateBranch;

use App\Repositories\ShippingGovernorateBranch\ShippingGovernorateBranchRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\ShippingGovernorateBranch\ShippingGovernorateBranchStoreRequest;
use App\Http\Requests\Admin\ShippingGovernorateBranch\ShippingGovernorateBranchUpdateRequest;
use App\Http\Resources\Admin\ShippingGovernorateBranch\ShippingGovernorateBranchResource;

class ShippingGovernorateBranchController extends BaseController
{
    public function __construct(ShippingGovernorateBranchRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'ShippingGovernorateBranch'
        );

        $this->storeRequestClass = ShippingGovernorateBranchStoreRequest::class;
        $this->updateRequestClass = ShippingGovernorateBranchUpdateRequest::class;
        $this->resourceClass = ShippingGovernorateBranchResource::class;
    }
}
