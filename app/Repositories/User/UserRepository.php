<?php

namespace App\Repositories\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}