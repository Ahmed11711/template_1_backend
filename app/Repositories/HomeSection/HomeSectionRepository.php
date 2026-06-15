<?php

namespace App\Repositories\HomeSection;

use App\Repositories\HomeSection\HomeSectionRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\HomeSection;

/**
 * Class HomeSectionRepository
 * @package App\Repositories\HomeSection
 */
class HomeSectionRepository extends BaseRepository implements HomeSectionRepositoryInterface
{
    /**
     * HomeSectionRepository constructor.
     *
     * @param HomeSection $model
     */
    public function __construct(HomeSection $model)
    {
        parent::__construct($model);
    }
}