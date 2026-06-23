<?php

namespace App\Http\Resources\Admin\Section;

use App\Http\Resources\Admin\Section\SectionItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Section
 */
class SectionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'page_id'    => $this->page_id,
            'type'       => $this->type,
            'order'      => $this->order,
            'props'      => $this->props,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'items'      => SectionItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
