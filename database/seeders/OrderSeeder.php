<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate orders with a random amount of items related to a product
        Order::factory()->count(500)->create()->each(function ($order) {
            $order
                ->items()
                ->saveMany(OrderItem::factory()
                    ->count(rand(2,10))
                    ->make([
                        'created_at' => $order->created_at,
                        'updated_at' => $order->updated_at,
                    ])
                );
        });
    }
}
