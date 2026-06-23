<?php
namespace Database\Factories;
use App\Models\Reviews;
use Illuminate\Database\Eloquent\Factories\Factory;
class ReviewsFactory extends Factory {
    protected $model = Reviews::class;
    public function definition(): array {
        return [
            'product_id' => 1,
            'user_id' => 1,
            'guest_name' => $this->faker->word,
            'rating' => $this->faker->word,
            'comment' => $this->faker->word,
            'is_approved' => $this->faker->word,
        ];
    }
}