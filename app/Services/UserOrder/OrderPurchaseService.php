<?php

namespace App\Services\UserOrder;

use App\Models\Order;
use App\Models\UserBalance;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderPurchaseService
{
    /**
     * تحقق من الرصيد، اخصم، وارجع الـ data جاهزة للحفظ
     * الـ DB::transaction موجود في BaseController فمش محتاجينه هنا
     */
    public function prepareOrderData(int $userId, array $data): array
    {
        $order      = Order::lockForUpdate()->findOrFail($data['order_id']);
        $countChair = (int) $data['seats_count'];


        $remainingSeats = $order->total_seats - $order->available_seats;

        if ($remainingSeats < $countChair) {
            throw ValidationException::withMessages([
                'seats_count' => ['المقاعد المطلوبة غير متاحة، المتاح: ' . $remainingSeats],
            ]);
        }

        $totalPrice = $order->seat_price * $countChair;

        $this->deductBalance($userId, $totalPrice);

        $order->increment('available_seats', $countChair);
        return [
            ...$data,
            'user_id'        => $userId,
            // 'seats_count'    => $order->seat_price,
            'price'          => $totalPrice,
            'transaction_id' => 'TXN-' . strtoupper(Str::random(10)),
            'status'         => 'confirmed',
            'payment_status' => 'paid',
            'payment_method' => 'wallet',
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────

    private function deductBalance(int $userId, float $amount): void
    {
        $userBalance = UserBalance::where('user_id', $userId)
            ->lockForUpdate()
            ->firstOrFail();

        if ($userBalance->balance < $amount) {
            throw ValidationException::withMessages([
                'balance' => ['الرصيد غير كافٍ، رصيدك الحالي: ' . $userBalance->balance . ' ج.م'],
            ]);
        }

        $userBalance->decrement('balance', $amount);
    }
}
