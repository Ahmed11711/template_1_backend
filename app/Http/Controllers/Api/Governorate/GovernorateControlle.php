<?php

namespace App\Http\Controllers\Api\Governorate;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ShippingGovernorate\ShippingGovernorateResource;
use App\Http\Resources\Admin\ShippingMethod\ShippingMethodResource;
use App\Models\ShippingMethod;
use App\Repositories\ShippingGovernorate\ShippingGovernorateRepositoryInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class GovernorateControlle extends Controller
{
    use ApiResponseTrait;
    public function index(ShippingGovernorateRepositoryInterface $repository)
    {
        $shippingMethod = ShippingMethod::where('is_active', 1)->first();
        $governorates = $repository->AllActive();
        return $this->successResponse([
            'shipping_method' => new ShippingMethodResource($shippingMethod),
            'governorates' => ShippingGovernorateResource::collection($governorates),
        ]);
    }
}
