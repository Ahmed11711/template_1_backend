<?php
namespace Database\Factories;
use App\Models\Pages;
use Illuminate\Database\Eloquent\Factories\Factory;
class PagesFactory extends Factory {
    protected $model = Pages::class;
    public function definition(): array {
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'is_active' => $this->faker->word,
        ];
    }
}