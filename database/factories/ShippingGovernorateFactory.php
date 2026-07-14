<?php
namespace Database\Factories;
use App\Models\ShippingGovernorate;
use Illuminate\Database\Eloquent\Factories\Factory;
class ShippingGovernorateFactory extends Factory {
    protected $model = ShippingGovernorate::class;
    public function definition(): array {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->word,
            'is_active' => $this->faker->word,
        ];
    }
}