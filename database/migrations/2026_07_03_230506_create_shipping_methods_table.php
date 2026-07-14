<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();

            $table->string('name')->default('طريقة الشحن الأساسية');

            // نوع طريقة الشحن اللي الأدمن اختارها
            $table->enum('type', ['free', 'flat', 'percentage', 'governorate'])
                ->comment('free = مجاني | flat = مبلغ ثابت | percentage = نسبة من المشتريات | governorate = حسب المحافظات');

            // خاص بـ flat (مبلغ ثابت)
            $table->decimal('flat_rate', 10, 2)->nullable();

            // خاص بـ percentage (نسبة من إجمالي المشتريات)
            $table->decimal('percentage_value', 5, 2)->nullable()
                ->comment('مثال: 5.00 يعني 5%');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
