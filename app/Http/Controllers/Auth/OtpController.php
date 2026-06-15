<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendOtpRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Models\User;
use App\Services\Auth\OtpService;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    use ApiResponseTrait;
    public function __construct(public OtpService $otpService) {}

    public function send(SendOtpRequest $request)
    {
        try {
            // Get context from route defaults
            $context = $request->route('context');
            $result = $this->otpService->sendOtp(
                $request->identifier,
                $context
            );


            return response()->json($result, 200);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function verify(VerifyOtpRequest $request): JsonResponse
    {
        try {
            // Get context from route defaults
            $context = $request->route('context');

            $this->otpService->verifyOtp(
                $request->identifier,
                $request->otp,
                $context
            );
            if ($context === 'forget_password') {
                $user = User::where('email', $request->identifier)
                    ->orWhere('phone', $request->identifier)
                    ->first();

                if ($user) {
                    $user->update(['password' => Hash::make($request->password)]);
                }
            }
            return $this->messageResponse("OTP verified successfully for", 200);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
