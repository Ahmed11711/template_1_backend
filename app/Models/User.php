<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use \App\Casts\ImageCast;
use \App\Models\Category;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


#[Fillable(['id', 'name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements JWTSubject
{

    public array $searchable = ['email', 'name', 'phone'];
    public array $filterable = ['is_active'];
    public array $allowedFields = ['id', 'name', 'email', 'phone', 'avatar', 'role', 'is_active', 'email_verified_at', 'created_at', 'updated_at'];



    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'avatar' => ImageCast::class,

        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'user_id' => $this->id,
            'email'   => $this->email ?? null,
            'role'    => $this->role ?? null,
        ];
    }

    public function getProfileCompletion(): array
    {
        $fields = [
            'name'         => $this->name,
            'email'        => $this->email,
            'phone'        => $this->phone,
            'user_name'    => $this->user_name,
            'whtsapp'      => $this->whtsapp,
            'country_code' => $this->country_code,
            'is_verified'  => $this->is_verified,
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
