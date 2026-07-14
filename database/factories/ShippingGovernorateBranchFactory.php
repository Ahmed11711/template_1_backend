<?php
namespace Database\Factories;
use App\Models\ShippingGovernorateBranch;
use Illuminate\Database\Eloquent\Factories\Factory;
class ShippingGovernorateBranchFactory extends Factory {
    protected $model = ShippingGovernorateBranch::class;
    public function definition(): array {
        return [
            'shipping_governorate_id' => 1,
            'name' => $this->faker->word,
            'price' => $this->faker->word,
            'is_active' => $this->faker->word,
        ];
    }
}