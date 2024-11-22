<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index () {
        // customer’s name, email, count of orders, and total spent
        $customers = Customer::withCount('orders')
            ->paginate(15);

        // Append the `total_sales` attribute to each item in the collection
        $customers->getCollection()->map(function ($customer) {
            $customer->total = $customer->total;
            return $customer;
        });

        return Inertia::render('Customers', [
            'customers' => $customers
        ]);
    }

    public function show ($id) {
        // get the customer with orders and orderItems
        $customer = Customer::findOrFail($id)
            ->append('total');

        $orders = $customer
            ->orders()
            ->paginate(5);

        $products = new Product;
        $topProduct = $products->topProductsByCustomer($id, 1)
            ->first();

        return Inertia::render('CustomerDetail', [
            'customer' => $customer,
            'orders' => $orders,
            'topProduct' => $topProduct
        ]);
    }
}
