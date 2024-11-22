<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Order extends Model
{
    use HasFactory;

    public const allowedStatuses = [
        'pending',
        'processing',
        'shipped',
        'delivered',
        'cancelled',
        'on hold',
        'returned',
        'refunded'
    ];

    protected $appends = ['total'];
    private $cacheTTL = 3600;
    protected $fillable = [
        'customer_id',
        'status',
        'billing_address_line_1',
        'billing_address_line_2',
        'billing_city',
        'billing_state',
        'billing_post_code',
        'billing_country',
        'shipping_address_line_1',
        'shipping_address_line_2',
        'shipping_city',
        'shipping_state',
        'shipping_post_code',
        'shipping_country',
        'credit_card_type',
        'credit_card_last_four',
        'customer_note'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute()
    {
        return round($this->items->sum('total'), 2);
    }

    public function statusCounts($startDate = null, $endDate = null){
        // used to sanitize the timestamps for cache key use
        $cacheDate = '';

        if(isset($startDate)){
            $cacheDate .= preg_replace('/[^a-zA-Z0-9-_\.]/','', $startDate);
        }
        if(isset($endDate)){
            $cacheDate .= "_" . preg_replace('/[^a-zA-Z0-9-_\.]/','', $endDate);
        }

        // cache the query because it's somewhat intensive and only used for reports
        return Cache::remember('status-counts--' . $cacheDate, $this->cacheTTL, function () use ($startDate, $endDate) {
            return $this
                ->select('status', \DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();
        });
    }
}
