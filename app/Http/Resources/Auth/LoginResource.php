<?php

namespace App\Http\Resources\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email ?? null,
            'phone'             => $this->phone ?? null,
            'user_name'         => $this->user_name,
            'whtsapp'           => $this->whtsapp, // Fixed typo from 'whatsapp' if that's your DB column name
            'country_code'      => $this->country_code,
            'is_active'         => (int) $this->is_active,
            'is_verified'       => !is_null($this->email_verified_at),
            'role'              => $this->role,
            'image'              => $this->image
                ? asset($this->image)
                : null,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'profile_completion' => $this->getProfileCompletion($this->resource),
        ];
    }

    public function getProfileCompletion(User $user): array
    {
        $fields = [
            'name'         => $user->name,
            'email'        => $user->email,
            'phone'        => $user->phone,
            'user_name'    => $user->user_name,
            'whtsapp'      => $user->whtsapp,
            'country_code' => $user->country_code,
            'is_verified'  => $user->is_verified,
        ];

        $completed = array_filter($fields, fn($val) => !is_null($val) && $val !== '' && $val !== false);
        $percentage = (int) round((count($completed) / count($fields)) * 100);

        return [
            'percentage'       => $percentage,
            'completed_fields' => array_keys($completed),
            'missing_fields'   => array_keys(array_diff_key($fields, $completed)),
        ];
    }
}
