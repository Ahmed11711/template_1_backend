<?php
namespace Database\Factories;
use App\Models\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
class ShippingMethodFactory extends Factory {
    protected $model = ShippingMethod::class;
    public function definition(): array {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->word,
            'flat_rate' => $this->faker->word,
            'percentage_value' => $this->faker->word,
            'is_active' => $this->faker->word,
        ];
    }
}