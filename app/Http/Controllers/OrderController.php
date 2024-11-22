<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        // customer’s name, email, count of orders, and total spent
        $orders = Order::with('customer')
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Orders', [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $order = Order::with('customer')
            ->findOrFail($id);

        return Inertia::render('OrderDetail', [
            'order' => $order
        ]);
    }
}
