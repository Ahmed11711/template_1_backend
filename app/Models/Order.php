<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'name',
        'email',
        'phone',
        'phone2',
        'address',
        'shipping_method_id',
        'shipping_method_type',
        'governorate_id',
        'governorate_name',
        'branch_id',
        'branch_name',
        'shipping_cost',
        'payment_gateway_id',
        'payment_gateway_name',
        'requires_receipt',
        'receipt_path',
        'subtotal',
        'total',
        'status',
    ];

    protected $casts = [
        'requires_receipt' => 'boolean',
        'shipping_cost' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->order_number ??= 'ORD-' . strtoupper(Str::random(8));
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // عدّل اسم الكلاس هنا لو الموديل عندك اسمه مختلف عن ده
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(\App\Models\ShippingGovernorate::class, 'governorate_id');
    }

    // عدّل اسم الكلاس هنا لو الموديل عندك اسمه مختلف عن ده
    public function branch(): BelongsTo
    {
        return $this->belongsTo(\App\Models\ShippingGovernorateBranch::class, 'branch_id');
    }

    public function paymentGateway(): BelongsTo
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
