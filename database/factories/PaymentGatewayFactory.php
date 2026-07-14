<?php
namespace Database\Factories;
use App\Models\PaymentGateway;
use Illuminate\Database\Eloquent\Factories\Factory;
class PaymentGatewayFactory extends Factory {
    protected $model = PaymentGateway::class;
    public function definition(): array {
        return [
            'name' => $this->faker->word,
            'image' => $this->faker->word,
            'value' => $this->faker->word,
            'requires_receipt' => $this->faker->word,
            'is_active' => $this->faker->word,
        ];
    }
}