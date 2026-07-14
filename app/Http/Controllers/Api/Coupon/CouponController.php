<?php

namespace App\Http\Controllers\Api\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Coupon\CouponResource;
use App\Repositories\Coupon\CouponRepositoryInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use ApiResponseTrait;

    public function __construct(public CouponRepositoryInterface $repository) {}

    public function index()
    {
        $coupons = $this->repository->allActive();
        return $this->successResponse(CouponResource::collection($coupons), 'All coupons');
    }

    public function apply(Request $request)
    {
        $request->validate([
            'code'     => 'required|string',
            'subtotal' => 'nullable|numeric|min:0',
        ]);

        $user = $request->user(); // لو الـ CheckJwtToken بتاعك بيربط اليوزر بطريقة تانية (مثلاً auth('api')->user()) بدلها هنا

        if (!$user) {
            return $this->errorResponse('يجب تسجيل الدخول لاستخدام الكوبون', 401);
        }

        $coupon = $this->repository->findByCode(trim($request->code));

        if (!$coupon) {
            return $this->errorResponse('كود الكوبون غير صحيح', 404);
        }

        if (!$coupon->is_active) {
            return $this->errorResponse('هذا الكوبون غير مفعل حالياً', 422);
        }

        if ($coupon->expires_at && now()->greaterThan($coupon->expires_at)) {
            return $this->errorResponse('انتهت صلاحية هذا الكوبون', 422);
        }

        if (!is_null($coupon->max_uses) && $coupon->used_count >= $coupon->max_uses) {
            return $this->errorResponse('تم استنفاد عدد مرات استخدام هذا الكوبون', 422);
        }

        $alreadyUsed = $coupon->usages()->where('user_id', $user->id)->exists();
        if ($alreadyUsed) {
            return $this->errorResponse('لقد استخدمت هذا الكوبون من قبل', 422);
        }

        if (
            $request->filled('subtotal')
            && !is_null($coupon->min_order_amount)
            && (float) $request->subtotal < (float) $coupon->min_order_amount
        ) {
            return $this->errorResponse(
                'الحد الأدنى للطلب لاستخدام هذا الكوبون هو ' . number_format($coupon->min_order_amount, 2),
                422
            );
        }

        return $this->successResponse(new CouponResource($coupon), 'الكوبون صالح ويمكن استخدامه');
    }
}
