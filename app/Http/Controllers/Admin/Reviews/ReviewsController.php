<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Repositories\Reviews\ReviewsRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Reviews\ReviewsStoreRequest;
use App\Http\Requests\Admin\Reviews\ReviewsUpdateRequest;
use App\Http\Resources\Admin\Reviews\ReviewsResource;

class ReviewsController extends BaseController
{
    public function __construct(ReviewsRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Reviews'
        );

        $this->storeRequestClass = ReviewsStoreRequest::class;
        $this->updateRequestClass = ReviewsUpdateRequest::class;
        $this->resourceClass = ReviewsResource::class;
    }
}
