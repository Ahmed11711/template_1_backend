<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Requests\Api\Order\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $order = DB::transaction(function () use ($data, $request) {

            $receiptPath = null;
            if ($request->hasFile('receipt')) {
                $receiptPath = $request->file('receipt')->store('receipts', 'public');
            }

            $order = Order::create([
                'user_id' => Auth::id(), // null لو زائر (guest checkout)

                'name' => $data['customer']['name'],
                'email' => $data['customer']['email'],
                'phone' => $data['customer']['phone'],
                'phone2' => $data['customer']['phone2'] ?? null,

                'address' => $data['shipping']['address'],
                'shipping_method_id' => $data['shipping']['shipping_method_id'] ?? null,
                'shipping_method_type' => $data['shipping']['shipping_method_type'] ?? null,
                'governorate_id' => $data['shipping']['governorate_id'],
                'governorate_name' => $data['shipping']['governorate_name'] ?? null,
                'branch_id' => $data['shipping']['branch_id'] ?? null,
                'branch_name' => $data['shipping']['branch_name'] ?? null,
                'shipping_cost' => $data['shipping']['shipping_cost'],

                'payment_gateway_id' => $data['payment']['gateway_id'],
                'payment_gateway_name' => $data['payment']['gateway_name'] ?? null,
                'requires_receipt' => $data['payment']['requires_receipt'] ?? false,
                'receipt_path' => $receiptPath,

                'subtotal' => $data['totals']['subtotal'],
                'total' => $data['totals']['total'],

                'status' => 'pending',
            ]);

            foreach ($data['items'] as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'size' => $item['size'] ?? null,
                    'line_total' => $item['line_total'],
                ]);
            }

            return $order;
        });

        return response()->json([
            'message' => 'تم إنشاء الطلب بنجاح',
            'data' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
            ],
        ], 201);
    }

    public function show(Order $order)
    {
        return response()->json([
            'data' => $order->load('items'),
        ]);
    }

    public function index()
    {
        return response()->json([
            'data' => Order::with('items')
                ->when(Auth::check(), fn($q) => $q->where('user_id', Auth::id()))
                ->latest()
                ->paginate(15),
        ]);
    }
}
