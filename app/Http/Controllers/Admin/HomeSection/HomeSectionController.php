<?php

namespace App\Http\Controllers\Admin\HomeSection;

use App\Repositories\HomeSection\HomeSectionRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\HomeSection\HomeSectionStoreRequest;
use App\Http\Requests\Admin\HomeSection\HomeSectionUpdateRequest;
use App\Http\Resources\Admin\HomeSection\HomeSectionResource;

class HomeSectionController extends BaseController
{
    public function __construct(HomeSectionRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'HomeSection'
        );

        $this->storeRequestClass = HomeSectionStoreRequest::class;
        $this->updateRequestClass = HomeSectionUpdateRequest::class;
        $this->resourceClass = HomeSectionResource::class;
    }
}
