<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // get a random Product, selecting only id since that's all we need
        $product = Product::select('id')
            ->inRandomOrder()
            ->first();

        return [
            'product_id' => $product->id,
            'quantity' => rand(1,20),
            'customer_note' => fake()->paragraph
        ];
    }
}
