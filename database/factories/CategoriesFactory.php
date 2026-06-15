<?php
namespace Database\Factories;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;
class CategoriesFactory extends Factory {
    protected $model = Categories::class;
    public function definition(): array {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->word,
            'description' => $this->faker->word,
            'is_featured' => $this->faker->word,
            'image' => $this->faker->word,
            'sort_order' => $this->faker->word,
            'is_active' => $this->faker->word,
            'meta_title' => $this->faker->word,
            'meta_description' => $this->faker->word,
            'promotional_text' => $this->faker->word,
        ];
    }
}