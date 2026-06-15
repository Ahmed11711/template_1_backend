<?php
namespace Database\Factories;
use App\Models\HomeSection;
use Illuminate\Database\Eloquent\Factories\Factory;
class HomeSectionFactory extends Factory {
    protected $model = HomeSection::class;
    public function definition(): array {
        return [
            'title' => $this->faker->word,
            'color' => $this->faker->word,
            'sort_order' => $this->faker->word,
            'is_active' => $this->faker->word,
        ];
    }
}