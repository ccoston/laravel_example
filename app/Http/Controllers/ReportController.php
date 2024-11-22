<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ReportController extends Controller
{

    /**
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function bestSellers(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $product = new Product;
        $bestSellers = $product->topProducts(10, \Carbon\Carbon::today()->subDays(7));

        return inertia('Reports/BestSellers', [
            'bestSellers' => $bestSellers,
        ]);
    }

    /**
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function bestCustomers(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $customer = new Customer;
        $bestCustomers = $customer->topCustomers(10, \Carbon\Carbon::today()->subDays(7));

        return inertia('Reports/BestCustomers', [
            'customers' => $bestCustomers,
        ]);
    }

    /**
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function orderStatus(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $order = new Order;
        $orderStatusCounts = $order->statusCounts();

        return inertia('Reports/OrderStatus', [
            'orderStatusCounts' => $orderStatusCounts,
        ]);
    }
}
