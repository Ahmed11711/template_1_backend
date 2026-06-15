<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id(); // معرف فريد للـ variant نفسه

            // Relations
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            // ربط الـ variant بالمنتج الأساسي، ولو المنتج اتمسح يتمسح معاه

            // Variant Identity
            $table->string('sku')->unique()->nullable();
            // كود فريد لكل variant بالذات (لتتبع المخزون والفواتير)

            // Attributes (e.g. Color: Black, Storage: 128GB)
            $table->string('color')->nullable();   // لون الـ variant
            $table->string('storage')->nullable(); // سعة التخزين
            $table->string('size')->nullable();    // المقاس (لو منتج فيه مقاسات)

            // Pricing & Stock (لكل variant سعر ومخزون منفصل)
            $table->decimal('price_adjustment', 10, 2)->default(0);
            // فرق السعر عن base_price بتاع المنتج (موجب أو سالب)

            $table->unsignedInteger('stock')->default(0);
            // المخزون الخاص بهذا الـ variant فقط

            // Status
            $table->boolean('is_active')->default(true);
            // لإيقاف variant معين دون التأثير على باقي variants المنتج

            $table->timestamps(); // created_at و updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
