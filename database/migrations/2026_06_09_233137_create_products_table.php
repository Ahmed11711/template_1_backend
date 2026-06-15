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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            // Basic Info
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('sku')->unique()->nullable(); // كود المنتج

            // Pricing
            $table->decimal('price', 10, 2);
            $table->decimal('compare_price', 10, 2)->nullable(); // السعر قبل الخصم
            $table->decimal('cost_price', 10, 2)->nullable(); // سعر التكلفة للأدمن بس

            // Stock
            $table->boolean('track_stock')->default(true); // هل له مخزون 
            $table->integer('stock_quantity')->default(0); // الكميه
            $table->integer('low_stock_threshold')->default(5); // ينبه لما الستوك يوصل لرقم معين


            // Display
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            // Stats
            $table->unsignedInteger('views_count')->default(0);
            // عدد مرات دخول العميل لصفحة المنتج (لمعرفة الأكتر شعبية)

            $table->decimal('average_rating', 3, 2)->default(0);
            // متوسط التقييم (مثلاً 4.50) — بيتحسب تلقائي من جدول reviews

            $table->unsignedInteger('reviews_count')->default(0);
            // عدد التقييمات الكلي (عشان ميتحسبش average_rating من جدول reviews كل مرة - cache)

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
