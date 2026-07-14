<?php

namespace App\Http\Controllers\Api\PaymentGetway;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PaymentGateway\PaymentGatewayResource;
use App\Repositories\PaymentGateway\PaymentGatewayRepositoryInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PaymentgetwayController extends Controller
{
    use ApiResponseTrait;
    public function __construct(public PaymentGatewayRepositoryInterface $repository) {}

    public function index()
    {
        $paymentGateways = $this->repository->allActive();
        return $this->successResponse(PaymentGatewayResource::collection($paymentGateways), 'All Payment');
    }
}
