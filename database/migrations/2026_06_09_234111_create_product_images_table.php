<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            // Image
            $table->string('image');
            $table->boolean('is_primary')->default(false); // الصورة الرئيسية المعروضة في الكروت
            $table->unsignedInteger('sort_order')->default(0); // ترتيب العرض في الجاليري

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
