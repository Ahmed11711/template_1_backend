<?php
namespace Database\Factories;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductsFactory extends Factory {
    protected $model = Products::class;
    public function definition(): array {
        return [
            'category_id' => 1,
            'name' => $this->faker->word,
            'slug' => $this->faker->word,
            'short_description' => $this->faker->word,
            'description' => $this->faker->word,
            'sku' => $this->faker->word,
            'price' => $this->faker->word,
            'compare_price' => $this->faker->word,
            'cost_price' => $this->faker->word,
            'track_stock' => $this->faker->word,
            'stock_quantity' => $this->faker->word,
            'low_stock_threshold' => $this->faker->word,
            'is_active' => $this->faker->word,
            'is_featured' => $this->faker->word,
            'sort_order' => $this->faker->word,
            'meta_title' => $this->faker->word,
            'meta_description' => $this->faker->word,
            'views_count' => $this->faker->word,
            'average_rating' => $this->faker->word,
            'reviews_count' => $this->faker->word,
        ];
    }
}