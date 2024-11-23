<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;


class DashboardController extends Controller
{
    /**
     * Show the dashboard view
     * @return \Inertia\Response
     */
    public function show(): \Inertia\Response
    {
        // get the start date for seven days ago
        $lastSevenStartDate = \Carbon\Carbon::today()->subDays(7);

        // get the count of orders placed in the last seven days
        $latestOrdersCount = Order::select('*')
            ->where('created_at','>=', $lastSevenStartDate)
            ->count();

        // get the top three products based on sales quantity for the past seven days
        $product = new Product;
        $topThreeProducts = $product->topProducts(3, $lastSevenStartDate);

        // get the top three customers based on order totals for the past seven days
        $customers = new Customer;
        $topThreeCustomers = $customers->topCustomers(3, $lastSevenStartDate);

        return Inertia::render('Dashboard', [
            'latestOrdersCount' =>  $latestOrdersCount,
            'topThreeProducts' => $topThreeProducts,
            'topThreeCustomers' => $topThreeCustomers
        ]);
    }

    /**
     * @param $count
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    private function topProducts($count, $startDate = null, $endDate = null): mixed
    {
        return Product::withCount(['items as item_count' => function ($query) use ($startDate, $endDate){
            $query->select(\DB::raw('coalesce(sum(quantity), 0)'));
            if($startDate && !$endDate){
                $query->where('created_at', '>=', $startDate);
            }
            if($startDate && $endDate){
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }])
        ->orderByDesc('item_count')
        ->take($count)
        ->get();
    }
}
