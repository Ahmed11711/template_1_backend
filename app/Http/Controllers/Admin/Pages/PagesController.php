<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Pages\PagesStoreRequest;
use App\Http\Requests\Admin\Pages\PagesUpdateRequest;
use App\Http\Resources\Admin\Pages\PagesResource;
use App\Repositories\Pages\PagesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends BaseController
{
    public function __construct(PagesRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Pages'
        );

        $this->storeRequestClass = PagesStoreRequest::class;
        $this->updateRequestClass = PagesUpdateRequest::class;
        $this->resourceClass = PagesResource::class;
        $this->withRelationships = ['sections.items'];
    }

    protected function beforeStore(array $data, Request $request): array
    {
        $data['slug'] = $this->generateUniqueSlug($data['title']);
        return $data;
    }

    protected function beforeUpdate(array $data, $existingRecord, Request $request): array
    {
        if (!empty($data['title'])) {
            $data['slug'] = $this->generateUniqueSlug($data['title'], $existingRecord->id);
        }
        return $data; // ← كنت ناسي الـ return دي
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (true) {
            $query = $this->repository->query()->where('slug', $slug);

            // لو update متحسبش الـ record نفسه
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}
