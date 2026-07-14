<?php

namespace App\Repositories\PaymentGateway;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

/**
 * Interface PaymentGatewayRepositoryInterface
 * @package App\Repositories\PaymentGateway
 */
interface PaymentGatewayRepositoryInterface extends BaseRepositoryInterface
{
    public function allActive();
}
