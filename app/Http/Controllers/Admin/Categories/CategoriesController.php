<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Repositories\Categories\CategoriesRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Categories\CategoriesStoreRequest;
use App\Http\Requests\Admin\Categories\CategoriesUpdateRequest;
use App\Http\Resources\Admin\Categories\CategoriesResource;

class CategoriesController extends BaseController
{
    public function __construct(CategoriesRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Categories',
            fileFields: ['image']
        );

        $this->storeRequestClass = CategoriesStoreRequest::class;
        $this->updateRequestClass = CategoriesUpdateRequest::class;
        $this->resourceClass = CategoriesResource::class;
    }

    protected function getShowRelationships(): array
    {
        return [
            'products',
            'products.images',
            'products.variants',
            'products.primaryImage',
            'products.firstImage',
        ];
    }
}
