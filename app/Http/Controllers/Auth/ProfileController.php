<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Services\Auth\AuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use ApiResponseTrait;
    public function __construct(public AuthService $authService) {}

    public function me(): JsonResponse
    {
        $user = $this->authService->getAuthenticatedUser();
        return $this->successResponse(new LoginResource($user));
    }


    public function logout(): JsonResponse
    {
        $this->authService->handleLogout();
        return $this->messageResponse('Successfully logged out');
    }
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = auth()->user();
        $data = $request->validated();

        // ── Avatar (نفس فكرة BaseController::handleFileUploads) ──
        if ($request->hasFile('avatar')) {
            // حذف القديم
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // رفع الجديد بنفس نمط BaseController
            $file     = $request->file('avatar');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $data['image'] = $file->storeAs('uploads/User', $filename, 'public');
            // بدون أي /storage/ قبلها        }

            unset($data['avatar']);

            $user->update($data);

            return response()->json([
                'message' => 'تم تحديث البيانات بنجاح',
                'data'    => $this->formatUser($user->fresh()),
            ]);
        }
    }
    // POST /api/profile/change-password
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = auth()->user();

        // تحقق من كلمة المرور الحالية
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'كلمة المرور الحالية غير صحيحة',
                'errors'  => [
                    'current_password' => ['كلمة المرور الحالية غير صحيحة'],
                ],
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'تم تغيير كلمة المرور بنجاح',
        ]);
    }

    // ── Helper ───────────────────────────────────────────────────
    private function formatUser($user): array
    {
        $completionFields = ['name', 'email', 'phone', 'whtsapp', 'avatar'];
        $missing = collect($completionFields)
            ->filter(fn($f) => empty($user->$f))
            ->values()
            ->toArray();

        $filled      = count($completionFields) - count($missing);
        $percentage  = (int) round(($filled / count($completionFields)) * 100);

        return [
            'id'          => $user->id,
            'name'        => $user->name,
            'email'       => $user->email,
            'phone'       => $user->phone,
            'whtsapp'     => $user->whtsapp,
            'avatar' => $user->image ? asset('storage/' . $user->image) : null,

            'is_verified' => (bool) $user->email_verified_at,
            'profile_completion' => [
                'percentage'    => $percentage,
                'missing_fields' => $missing,
            ],
        ];
    }
}
