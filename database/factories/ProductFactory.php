<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
    return [
        'name' => fake()->words(2, true),
        'price' => fake()->numberBetween(10000, 500000),
        'category_id' => Category::factory(),
        'stock' => fake()->numberBetween(1, 100), // Sinh số lượng tồn kho ngẫu nhiên từ 1 đến 100
    ];
}
}
