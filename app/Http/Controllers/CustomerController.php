<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index (): \Inertia\Response
    {
        // customer’s name, email, count of orders, and total spent
        $customers = Customer::withCount('orders')
            ->paginate(15);

        return Inertia::render('Customers', [
            'customers' => $customers
        ]);
    }

    /**
     * @throws BindingResolutionException
     */
    public function show ($id): \Inertia\Response
    {
        $customer = Customer::with(['orders.items.product']) // Eager load orders and related data
        ->findOrFail($id)
            ->append('total');

        $orders = $customer->orders()->paginate(5);

        $topProduct = app()
            ->make('App\Models\Product')
            ->topProductsByCustomer($id, 1)
            ->first();

        return Inertia::render('CustomerDetail', [
            'customer' => $customer,
            'orders' => $orders,
            'topProduct' => $topProduct
        ]);
    }
}
