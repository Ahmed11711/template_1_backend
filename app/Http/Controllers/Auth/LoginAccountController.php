<?php

namespace App\Http\Controllers\Auth;

use \App\Http\Resources\Auth\LoginResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAccountBySocialRequest;
use App\Http\Requests\Auth\LoginAcountBySocialRequest;
use App\Http\Requests\Auth\LoginAcountRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginAccountController extends Controller
{


    public function __construct(public AuthService $authService) {}


    public function login(LoginAcountRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $result = $this->authService->handleLogin($credentials);
        return $this->respondWithToken($result['token'], $result['user']);
    }


    public function socialLogin(LoginAcountBySocialRequest $request): JsonResponse
    {
        $result = $this->authService->handleSocialLogin($request->validated());
        return $this->respondWithToken($result['token'], $result['user']);
    }

    protected function respondWithToken($token, $user): JsonResponse
    {
        return response()->json([
            'status' => true,
            'user' => new LoginResource($user),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function refresh()
    {
        $result = $this->authService->refresh();
        return $this->respondWithToken($result['token'], $result['user']);
    }
}
