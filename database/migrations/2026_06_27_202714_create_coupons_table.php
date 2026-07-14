<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_coupons_table.php
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['percentage', 'fixed']); // نسبة أو مبلغ ثابت
            $table->decimal('value', 8, 2);                // قيمة الخصم
            $table->decimal('min_order_amount', 8, 2)->default(0); // حد أدنى للأوردر
            $table->integer('max_uses')->nullable();        // حد أقصى للاستخدام
            $table->integer('used_count')->default(0);     // كام مرة اتستخدم
            $table->timestamp('expires_at')->nullable();   // تاريخ الانتهاء
            $table->boolean('is_active')->default(true);
            $table->integer('max_uses_per_user')->nullable(); // null = unlimited per user

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
