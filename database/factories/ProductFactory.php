<?php

namespace Database\Factories;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // extend Faker with service provider from library that adds commerce so we can fake product names
        $faker = Faker::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));

        return [
            'name' => $faker->productName,
            'sku' => $faker->unique()->regexify('[A-Z]{3}-[0-9]{3}-[A-Z]{2}'),
            'description' => $faker->paragraphs(rand(2,6), true),
            'price' => $faker->randomFloat(2, 1, 100),
            'image_url' => 'https://picsum.photos/seed/' . $faker->randomNumber(8) . '/536/350'
        ];
    }
}
