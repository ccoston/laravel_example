<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // get a random customer, selecting only id since that's all we need
        $customer = Customer::select('id')
            ->inRandomOrder()
            ->first();

        //randomize dateTime to use for random created_at and updated_at columns
        $timestamp = fake()
            ->dateTimeBetween($startDate = '-4 months', $endDate = 'now');

        // use fakeAddress() to generate a random address array
        $billingAddress = $this->fakeAddress();

        // Boolean to randomly present a different shipping address than billing
        $shippingDifferentThanBilling = 1 === rand(1,5);
        $shippingAddress = $shippingDifferentThanBilling ? $this->fakeAddress() : $billingAddress;

        return [
            'customer_id' => $customer->id,
            'status' => fake()->randomElement(Order::allowedStatuses),
            'billing_address_line_1' => $billingAddress['line_1'],
            'billing_address_line_2' => $billingAddress['line_2'],
            'billing_city' => $billingAddress['city'],
            'billing_state' => $billingAddress['state'],
            'billing_post_code' => $billingAddress['post_code'],
            'billing_country' => $billingAddress['country'],
            'shipping_address_line_1' => $shippingAddress['line_1'],
            'shipping_address_line_2' => $shippingAddress['line_2'],
            'shipping_city' => $shippingAddress['city'],
            'shipping_state' => $shippingAddress['state'],
            'shipping_post_code' => $shippingAddress['post_code'],
            'shipping_country' => $shippingAddress['country'],
            'credit_card_type' => fake()->creditCardType,
            'credit_card_last_four' => fake()->randomNumber(4),
            'customer_note' => fake()->paragraph,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];
    }

    /**
     * Generates a fake address
     * @return array
     */
    private function fakeAddress(): array
    {
        return [
            'line_1' => fake()->streetAddress,
            // randomly include a line_2 for some of the records
            'line_2' => 1 === rand(1,5) ? fake()->secondaryAddress : null,
            'city' => fake()->city,
            'state' => fake()->stateAbbr,
            'post_code' => fake()->postcode,
            'country' =>fake()->country
        ];
    }
}
