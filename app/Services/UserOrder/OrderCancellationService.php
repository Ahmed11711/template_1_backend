<?php

namespace App\Services\UserOrder;

use App\Models\Order;
use App\Models\UserBalance;
use App\Models\UserOrder;
use Illuminate\Validation\ValidationException;

class OrderCancellationService
{
    /**
     * إلغاء الحجز مع التحقق من الشروط
     * الـ DB::transaction موجود في BaseController
     */
    public function cancel(int $userId, int $userOrderId, ?string $reason = null): void
    {
        $userOrder = UserOrder::where('user_id', $userId)
            ->with('order')
            ->lockForUpdate()
            ->findOrFail($userOrderId);

        // ① تحقق إن الحجز مش ملغي أو مكتمل
        if (in_array($userOrder->status, ['cancelled', 'completed'])) {
            throw ValidationException::withMessages([
                'status' => ['لا يمكن إلغاء هذا الحجز'],
            ]);
        }

        // ② تحقق من عدد مرات الإلغاء في الشهر (max 3)
        $cancellationsThisMonth = UserOrder::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->count();

        if ($cancellationsThisMonth >= 3) {
            throw ValidationException::withMessages([
                'cancellation' => ['لقد استنفذت الحد الشهري للإلغاء (3 مرات)'],
            ]);
        }

        // ③ تحقق إن الإلغاء قبل الميعاد بساعتين على الأقل
        $this->ensureCancellableTime($userOrder->order);

        // ④ رجّع المقاعد
        $userOrder->order->decrement('available_seats', $userOrder->seats_count);

        // ⑤ رجّع الفلوس للمحفظة
        $this->refundBalance($userId, (float) $userOrder->price);

        // ⑥ حدّث الحجز
        $userOrder->update([
            'status' => 'cancelled',
            'notes'  => $reason,
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────

    private function ensureCancellableTime(Order $order): void
    {
        $dayIndex = [
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6,
        ];

        $targetDayIndex = $dayIndex[$order->day] ?? -1;
        $todayIndex     = now()->dayOfWeek;

        $daysUntil = ($targetDayIndex - $todayIndex + 7) % 7;

        // لو نفس اليوم ووقته عدى → الأسبوع الجاي
        if ($daysUntil === 0) {
            $departure = now()->setTimeFromTimeString($order->departure_time);
            if (now()->gte($departure)) {
                $daysUntil = 7;
            }
        }

        $departureDateTime = now()
            ->addDays($daysUntil)
            ->setTimeFromTimeString($order->departure_time);

        $hoursLeft = now()->diffInHours($departureDateTime, false);

        if ($hoursLeft < 2) {
            throw ValidationException::withMessages([
                'time' => ['لا يمكن الإلغاء قبل أقل من ساعتين من موعد المغادرة'],
            ]);
        }
    }

    // ─────────────────────────────────────────────────────────────────────────

    private function refundBalance(int $userId, float $amount): void
    {
        $balance = UserBalance::where('user_id', $userId)
            ->lockForUpdate()
            ->first();

        if (!$balance) {
            throw ValidationException::withMessages([
                'balance' => ['المحفظة غير موجودة'],
            ]);
        }

        $balance->increment('balance', $amount);
    }
}
