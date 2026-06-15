<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\JWTGuard;

class AuthService
{
    public function handleLogin(array $requestData): array
    {
        $loginField = filter_var($requestData['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $loginField => $requestData['login'],
            'password'  => $requestData['password']
        ];

        if (!$token = JWTAuth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'login' => ['Invalid login credentials.'],
            ]);
        }

    // Explicitly get the user from the attempt we just made
        /** @var User $user */
        $user = JWTAuth::user();
        // If it's still null, you can force it using the token:
        // $user = JWTAuth::setToken($token)->toUser();

        if ($user) {
            $user->update(['last_seen_at' => now()]);
        }

        return [
            'user'  => $user,
            'token' => $token
        ];
    }
    public function handleSocialLogin(array $data): array
    {
        return DB::transaction(function () use ($data) {
            // Find user by Social ID or Email (for account linking)
            $user = User::where('social_id', $data['social_id'])
                ->where('social_type', $data['social_type'])
                ->first()
                ?? User::where('email', $data['email'])->first();

            if ($user) {
                $user->update([
                    'social_id'     => $data['social_id'],
                    'social_type'   => $data['social_type'],
                    'last_seen_at' => now(),
                ]);
            } else {
                $user = User::create([
                    'name'          => $data['name'] ?? 'User_' . Str::random(5),
                    'email'         => $data['email'] ?? null,
                    'social_id'     => $data['social_id'],
                    'social_type'   => $data['social_type'],
                    'last_seen_at' => now(),
                    'password'      => null,
                ]);
            }

            return [
                'user'  => $user,
                'token' => JWTAuth::fromUser($user)
            ];
        });
    }


    /**
     * Refresh the current expired token
     * @return array
     */
    public function refresh()
    {
        /** @var \Tymon\JWTAuth\JWTGuard $guard */
        $guard = auth('api'); // Force the 'api' guard

        $newToken = $guard->refresh();
        $user = $guard->setToken($newToken)->user();

        return [
            'user'  => $user,
            'token' => $newToken
        ];
    }

    /**
     * Handle new user registration
     * @param array $data
     * @return array
     */
    public function handleRegister(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $user = User::create($data);

            return [
                'user'  => $user,
                'token' => JWTAuth::fromUser($user)
            ];
        });
    }

    /**
     * Get the authenticated user profile
     * @return \App\Models\User|null
     */
    public function getAuthenticatedUser()
    {
        $user = auth('api')->user();

        // $user->load('balance');

        return $user;
    }

    /**
     * Handle Logout
     */
    public function handleLogout(): void
    {
        /** @var \Tymon\JWTAuth\JWTGuard $auth */
        $auth = auth('api');

        $auth->logout();
    }
}
