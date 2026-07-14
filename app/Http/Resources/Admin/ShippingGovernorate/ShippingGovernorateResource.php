<?php

namespace App\Http\Resources\Admin\ShippingGovernorate;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\ShippingGovernorateBranch\ShippingGovernorateBranchResource;

/**
 * @mixin \App\Models\ShippingGovernorate
 */
class ShippingGovernorateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'price'      => $this->price,
            'is_active'  => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // الفروع التابعة للمحافظة دي — تظهر جوا نفس الـ object
            // عشان الفرونت يعرضها في الـ Accordion من غير request إضافي
            'branches'   => ShippingGovernorateBranchResource::collection(
                $this->whenLoaded('branches')
            ),
        ];
    }
}
