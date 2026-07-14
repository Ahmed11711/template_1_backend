<?php
namespace Database\Factories;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;
class CouponFactory extends Factory {
    protected $model = Coupon::class;
    public function definition(): array {
        return [
            'code' => $this->faker->word,
            'type' => $this->faker->word,
            'value' => $this->faker->word,
            'min_order_amount' => $this->faker->word,
            'max_uses' => $this->faker->word,
            'used_count' => $this->faker->word,
            'expires_at' => $this->faker->word,
            'is_active' => $this->faker->word,
        ];
    }
}