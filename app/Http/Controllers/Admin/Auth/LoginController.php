<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAcountRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Services\Auth\AuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends Controller
{
    use ApiResponseTrait;
    public function __construct(public AuthService $authService) {}


    public function login(LoginAcountRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $result = $this->authService->handleLogin($credentials);
        return $this->respondWithToken($result['token'], $result['user']);
    }
    public function me(): JsonResponse
    {
        $user = auth('api')->user();

        return $this->successResponse($user, "me");
        return $this->successResponse(new LoginResource($user));
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
}
