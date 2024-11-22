<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Customer extends Model
{
    use HasFactory;

    // set cache TTL to 1 hour.
    private $cacheTTL = 3600;
    protected $fillable = [
        'name',
        'email'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all of the deployments for the project.
     */
    public function items(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }

    public function getTotalAttribute()
    {
        $cacheKey = 'customer_total_' . $this->id;
        $cacheDuration = now()->addMinutes(30);

        $total = Cache::get($cacheKey);

        if ($total === null) {
            $total = number_format(round($this->orders->sum('total'), 2), 2);
            Cache::put($cacheKey, $total, $cacheDuration);
        }

        return $total;
    }

    public function topCustomers($count, $startDate = null, $endDate = null)
    {
        // used to sanitize the timestamps for cache key use
        $cacheDate = '';

        if(isset($startDate)){
            $cacheDate .= preg_replace('/[^a-zA-Z0-9-_\.]/','', $startDate);
        }
        if(isset($endDate)){
            $cacheDate .= "_" . preg_replace('/[^a-zA-Z0-9-_\.]/','', $endDate);
        }

        // cache the query because it's somewhat intensive and only used for reports
        return Cache::remember('top-customers-' . $count . $cacheDate, $this->cacheTTL, function () use ($startDate, $endDate, $count) {

            return $this
                ->withCount(['orders as order_count' => function ($query) use ($startDate, $endDate){
                    // add filter for start date for orders if provided but no end date provided
                    if($startDate && !$endDate){
                        $query->where('orders.created_at', '>=', $startDate);
                    }

                    // add start date and end date filtering for orders
                    if($startDate && $endDate){
                        $query->whereBetween('orders.created_at', [$startDate, $endDate]);
                    }
                }])
                ->withCount(['orders as order_total' => function ($query) use ($startDate, $endDate){
                    $query->select(\DB::raw('coalesce(sum(quantity * products.price), 0)'));
                    $query->join('order_items', 'orders.id', '=', 'order_items.order_id');
                    $query->join('products', 'order_items.product_id', '=', 'products.id');

                    // add filter for start date for orders if provided but no end date provided
                    if($startDate && !$endDate){
                        $query->where('orders.created_at', '>=', $startDate);
                    }

                    // add start date and end date filtering for orders
                    if($startDate && $endDate){
                        $query->whereBetween('orders.created_at', [$startDate, $endDate]);
                    }
                }])
                ->orderByDesc('order_total')
                ->take($count)
                ->get();
        });
    }
}
