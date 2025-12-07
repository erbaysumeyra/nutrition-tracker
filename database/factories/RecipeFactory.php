<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'calories' => $this->faker->numberBetween(50, 800),
            'protein' => $this->faker->numberBetween(0, 100),
            'carbs' => $this->faker->numberBetween(0, 150),
            'fat' => $this->faker->numberBetween(0, 100),
            'fiber' => $this->faker->numberBetween(0, 50),
            'carbon_footprint' => $this->faker->randomFloat(2, 0, 50),
            'description' => $this->faker->sentence(),
        ];
    }
}
