<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $category = Category::all();
        return [
            'category_id' => $category->random()->id,
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 1),
            'status' => fake()->randomElement([StatusEnum::Active, StatusEnum::Inactive])
        ];
    }
}
