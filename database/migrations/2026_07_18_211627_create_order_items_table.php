<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            // ممكن يكون رقم أو نص حسب الفرونت، فبنخليه string عشان يقبل الاتنين
            $table->string('product_id');

            // Snapshot لبيانات المنتج وقت الشراء (عشان لو المنتج اتغير سعره بعدين، الأوردر القديم يفضل صحيح)
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity');
            $table->string('size')->nullable();
            $table->decimal('line_total', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
