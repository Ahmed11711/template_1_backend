<?php

namespace App\Repositories\setting;

use App\Repositories\setting\settingRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\setting;

/**
 * Class settingRepository
 * @package App\Repositories\setting
 */
class settingRepository extends BaseRepository implements settingRepositoryInterface
{
    /**
     * settingRepository constructor.
     *
     * @param setting $model
     */
    public function __construct(setting $model)
    {
        parent::__construct($model);
    }
}