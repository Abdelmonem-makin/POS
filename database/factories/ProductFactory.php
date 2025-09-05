<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition()
    {
        return [
            'name' => fake()->name(),
            // 'photo' => fake()->imageUrl(300,400),
            // 'discription'=> fake()->sentence(6 ,false),
            'price'=> fake()->numberBetween(500,800),
            'Quantity'=> fake()->numberBetween(10,20),
            'minimum_Quantity'=> fake()->numberBetween(5,10),
            'sell_price'=> fake()->numberBetween(1000,2000),
            'status' =>fake()->randomElement([1,0]),
            'categories_id'=>fake()->randomElement(Category::pluck('id')->toArray()),
            'slug'=> fake()->unique()->slug

        ];
    }
}
