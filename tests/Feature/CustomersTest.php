<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate with it
        $user = User::factory()->create();
        $this->actingAs($user);
    }
    /** @test */
    public function customers_archive_is_a_paginated_table_of_customers()
    {
        // Create 30 customers
        Customer::factory()->count(30)->create();

        // Visit the customers archive page
        $response = $this->get(route('customers.index'));

        // Assert that the response status is 200 OK
        $response->assertOk();

        // Assert that the customers are displayed in a table
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Customers')
            // has paginated customer data with 15 records and specific attributes we need
            ->has('customers', fn (Assert $page) => $page
                ->has('data', 15, fn (Assert $page) => $page
                    ->has('id')
                    ->has('name')
                    ->has('email')
                    ->has('orders_count')
                    ->has('total')
                    ->has('orders')
                )
                // check for pagination props
                ->where('current_page', 1)
                ->where('per_page', 15)
                ->has('links')
                ->has('total')
                ->etc()
            )
        );
    }
}
