<?php

namespace App\Repositories\Reviews;

use App\Repositories\Reviews\ReviewsRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Reviews;

/**
 * Class ReviewsRepository
 * @package App\Repositories\Reviews
 */
class ReviewsRepository extends BaseRepository implements ReviewsRepositoryInterface
{
    /**
     * ReviewsRepository constructor.
     *
     * @param Reviews $model
     */
    public function __construct(Reviews $model)
    {
        parent::__construct($model);
    }
}