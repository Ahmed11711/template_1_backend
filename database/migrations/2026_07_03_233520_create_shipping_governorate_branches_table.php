<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping_governorate_branches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shipping_governorate_id')
                ->constrained('shipping_governorates')
                ->cascadeOnDelete();

            $table->string('name'); // اسم الفرع/المنطقة، مثال: الدقي
            $table->decimal('price', 10, 2); // سعر الشحن للفرع ده، مثال: 60

            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('shipping_governorate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_governorate_branches');
    }
};
