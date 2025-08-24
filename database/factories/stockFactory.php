<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\stock>
 */
class stockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'product_id'=>fake()->randomElement(Product::pluck('id')->toArray()),
        'supplier_id'=>fake()->randomElement(supplier::pluck('id')->toArray()),
        'user_id'=> fake()->randomElement(User::pluck('id')->toArray()),
        'expir_data'=>fake()->date(),
        'TransactionType'=>fake()->randomElement([1,0]),
        'price'=>fake()->randomFloat(10,2),
        'Quantity'=>fake()->numberBetween(10,2)
        ];
    }
}
