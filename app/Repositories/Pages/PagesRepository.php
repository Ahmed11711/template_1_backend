<?php

namespace App\Repositories\Pages;

use App\Repositories\Pages\PagesRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Pages;

/**
 * Class PagesRepository
 * @package App\Repositories\Pages
 */
class PagesRepository extends BaseRepository implements PagesRepositoryInterface
{
    /**
     * PagesRepository constructor.
     *
     * @param Pages $model
     */
    public function __construct(Pages $model)
    {
        parent::__construct($model);
    }
}