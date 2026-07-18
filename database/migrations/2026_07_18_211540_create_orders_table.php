<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // لو عندك جدول users ونظام تسجيل دخول، سيبها nullable عشان تقبل ضيف (guest) كمان
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // رقم أوردر مميز يتعرض للعميل (اختياري بس مفيد جدًا)
            $table->string('order_number')->unique();

            // ─── Customer ───
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('phone2')->nullable();

            // ─── Shipping ───
            $table->text('address');

            // بنخزن الـ id + snapshot من الاسم عشان لو المحافظة/الفرع اتغير أو اتمسح بعدين، الأوردر القديم يفضل زي ما هو
            $table->foreignId('shipping_method_id')->nullable()
                ->constrained('shipping_methods')->nullOnDelete();
            $table->string('shipping_method_type')->nullable(); // free | flat | percentage | governorate

            $table->foreignId('governorate_id')->nullable()
                ->constrained('shipping_governorates')->nullOnDelete();
            $table->string('governorate_name')->nullable();

            $table->foreignId('branch_id')->nullable()
                ->constrained('shipping_governorate_branches')->nullOnDelete();
            $table->string('branch_name')->nullable();

            $table->decimal('shipping_cost', 10, 2)->default(0);

            // ─── Payment ───
            $table->foreignId('payment_gateway_id')->nullable()
                ->constrained('payment_gateways')->nullOnDelete();
            $table->string('payment_gateway_name')->nullable();
            $table->boolean('requires_receipt')->default(false);
            $table->string('receipt_path')->nullable(); // مسار صورة الإيصال المرفوعة

            // ─── Totals ───
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total', 10, 2);

            // ─── Status ───
            $table->enum('status', [
                'pending',      // لسه مستني تأكيد/مراجعة الإيصال
                'confirmed',    // اتأكد
                'processing',
                'shipped',
                'delivered',
                'cancelled',
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
