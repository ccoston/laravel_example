<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Response;
use Inertia\ResponseFactory;

class ReportController extends Controller
{

    /**
     * @return Response|ResponseFactory
     */
    public function bestSellers(): Response|ResponseFactory
    {
        $product = new Product;
        $bestSellers = $product->topProducts(10, \Carbon\Carbon::today()->subDays(7));

        return inertia('Reports/BestSellers', [
            'bestSellers' => $bestSellers,
        ]);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function bestCustomers(): Response|ResponseFactory
    {
        $customer = new Customer;
        $bestCustomers = $customer->topCustomers(10, \Carbon\Carbon::today()->subDays(7));

        return inertia('Reports/BestCustomers', [
            'customers' => $bestCustomers,
        ]);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function orderStatus(): Response|ResponseFactory
    {
        $order = new Order;
        $orderStatusCounts = $order->statusCounts();

        return inertia('Reports/OrderStatus', [
            'orderStatusCounts' => $orderStatusCounts,
        ]);
    }
}
