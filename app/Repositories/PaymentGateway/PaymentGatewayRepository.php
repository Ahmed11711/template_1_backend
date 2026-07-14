<?php

namespace App\Repositories\PaymentGateway;

use App\Repositories\PaymentGateway\PaymentGatewayRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\PaymentGateway;

/**
 * Class PaymentGatewayRepository
 * @package App\Repositories\PaymentGateway
 */
class PaymentGatewayRepository extends BaseRepository implements PaymentGatewayRepositoryInterface
{
    /**
     * PaymentGatewayRepository constructor.
     *
     * @param PaymentGateway $model
     */
    public function __construct(PaymentGateway $model)
    {
        parent::__construct($model);
    }

    public function allActive()
    {
        return $this->model
            ->where('is_active', 1)
            ->get();
    }
}
