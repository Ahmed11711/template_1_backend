<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // اسم الضيف (Guest) لما يكتب من غير تسجيل دخول
            // لو user_id موجود، الاسم الحقيقي بييجي من جدول users مباشرة
            $table->string('guest_name')->nullable();

            $table->unsignedTinyInteger('rating')->default(5); // 1 -> 5
            $table->text('comment');
            $table->string('emoji')->nullable();

            $table->boolean('is_approved')->default(true);

            $table->timestamps();

            $table->index('product_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
