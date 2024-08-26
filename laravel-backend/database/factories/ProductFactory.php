<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = ProductCategory::first() ?? ProductCategory::factory()->create();
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'category_id' => $category->id,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discount' => $this->faker->optional()->randomFloat(2, 0, 100),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
