<?php

namespace App\Http\Controllers\Admin\PaymentGateway;

use App\Repositories\PaymentGateway\PaymentGatewayRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\PaymentGateway\PaymentGatewayStoreRequest;
use App\Http\Requests\Admin\PaymentGateway\PaymentGatewayUpdateRequest;
use App\Http\Resources\Admin\PaymentGateway\PaymentGatewayResource;

class PaymentGatewayController extends BaseController
{
    public function __construct(PaymentGatewayRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'PaymentGateway',
            fileFields: ['image']
        );

        $this->storeRequestClass = PaymentGatewayStoreRequest::class;
        $this->updateRequestClass = PaymentGatewayUpdateRequest::class;
        $this->resourceClass = PaymentGatewayResource::class;
    }
}
