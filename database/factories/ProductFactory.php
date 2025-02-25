<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        return [
            'product_name'=>fake()->name(),
            'description'=>fake()->text(),
            'image'=>'images.jpg',
            'price'=>fake()->numberBetween($min = 1000, $max = 10000),
            'stock_quantity'=>fake()->numberBetween($min = 1000, $max = 10000),
            'category_id'=>3,
        ];
    }
}
