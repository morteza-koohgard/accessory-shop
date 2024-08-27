<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryFeature>
 */
class CategoryFeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => ProductCategory::factory()->create()->id,
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(['text', 'number', 'select', 'multi_select']),
        ];
    }
}
