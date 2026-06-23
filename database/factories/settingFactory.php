<?php
namespace Database\Factories;
use App\Models\setting;
use Illuminate\Database\Eloquent\Factories\Factory;
class settingFactory extends Factory {
    protected $model = setting::class;
    public function definition(): array {
        return [
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'type' => $this->faker->word,
        ];
    }
}