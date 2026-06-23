<?php

namespace App\Repositories\Section;

use App\Repositories\Section\SectionRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Section;

/**
 * Class SectionRepository
 * @package App\Repositories\Section
 */
class SectionRepository extends BaseRepository implements SectionRepositoryInterface
{
    /**
     * SectionRepository constructor.
     *
     * @param Section $model
     */
    public function __construct(Section $model)
    {
        parent::__construct($model);
    }
}