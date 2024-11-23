<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasFactory;

    // set cache TTL to 1 hour.
    private $cacheTTL = 3600;
    protected $fillable = [
        'name',
        'sku',
        'price',
        'description',
        'imageURL',
    ];

    /**
     * Relation for the associated orderItems that relate to this product
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getLastSevenDaysCountAttribute()
    {
        return $this
            ->items
            ->where('created_at', '>=', \Carbon\Carbon::today()->subDays(7))
            ->sum('quantity');
    }

    /**
     * @param $count
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function topProducts($count, $startDate = null, $endDate = null): mixed
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
        return Cache::remember('top-products-' . $count . $cacheDate, $this->cacheTTL, function () use ($startDate, $endDate, $count) {

            $query = $this->query()
                ->join('order_items', 'order_items.product_id', '=', 'products.id')
                ->join('orders', 'orders.id', '=', 'order_items.order_id');

            if($startDate && !$endDate){
                $query->where('orders.created_at', '>=', $startDate);
            }
            if($startDate && $endDate){
                $query->whereBetween('orders.created_at', [$startDate, $endDate]);
            }

            $query
                ->selectRaw('products.*, SUM(order_items.quantity) as total_quantity')
                ->groupBy('products.id')
                ->orderByDesc('total_quantity')
                ->take($count);

            return $query->get();
        });
    }
    public function topProductsByCustomer($customer_id, $count, $startDate = null, $endDate = null)
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
        return Cache::remember('top-products-' .$customer_id . '_' . $count . $cacheDate, $this->cacheTTL, function () use ($startDate, $endDate, $count, $customer_id) {
            $query = $this->query()
                ->join('order_items', 'order_items.product_id', '=', 'products.id')
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->where('orders.customer_id', $customer_id);

            if($startDate && !$endDate){
                $query->where('orders.created_at', '>=', $startDate);
            }

            if($startDate && $endDate){
                $query->whereBetween('orders.created_at', [$startDate, $endDate]);
            }

            $query
                ->selectRaw('products.*, SUM(order_items.quantity) as total_quantity')
                ->groupBy('products.id')
                ->orderByDesc('total_quantity')
                ->take($count);

            return $query->get();
        });
    }
}
