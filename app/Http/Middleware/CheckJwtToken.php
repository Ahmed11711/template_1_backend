<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class CheckJwtToken
{
    use ApiResponseTrait;
    public function handle(Request $request, Closure $next, ...$roles)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return $this->errorResponse("User Not  Found");
            }

            $payload = JWTAuth::getPayload();
        } catch (TokenExpiredException $e) {
            try {
                $newToken = JWTAuth::refresh(JWTAuth::getToken());

                $user = JWTAuth::setToken($newToken)->toUser();
                $payload = JWTAuth::setToken($newToken)->getPayload();
                $request->headers->set('Authorization', 'Bearer ' . $newToken);
            } catch (JWTException $refreshEx) {
                return $this->errorResponse("Token expired and cannot be refreshed", 401);
            }
        } catch (TokenBlacklistedException $e) {
            return $this->errorResponse("This token is blacklisted (Logged out)", 401);
        } catch (TokenInvalidException $e) {
            return $this->errorResponse("Token is invalid", 401);
        } catch (JWTException $e) {
            return $this->errorResponse("Token not provided", 401);
        }





        $response = $next($request);

        if (isset($newToken)) {
            $response->headers->set('Authorization', 'Bearer ' . $newToken);
            $response->headers->set('Access-Control-Expose-Headers', 'Authorization');
        }

        return $response;
    }
}
