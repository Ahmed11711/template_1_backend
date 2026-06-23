<?php
namespace Database\Factories;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
class SectionFactory extends Factory {
    protected $model = Section::class;
    public function definition(): array {
        return [
            'page_id' => 1,
            'type' => $this->faker->word,
            'order' => $this->faker->word,
            'props' => $this->faker->word,
        ];
    }
}