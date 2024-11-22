<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

//    protected $appends = ['price'];
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'customer_note'
    ];

    /**
     * Get the order associated with this item
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product associated with this item.
     * * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Accessor that returns the price via the related product
     * @return mixed
     */
    public function getPriceAttribute()
    {
        return $this->product->price;
    }

    /**
     * Accessor that returns the total for this item by calculating quantity times price
     * @return float|int
     */
    public function getTotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }

    /**
     * Accessor that returns the product name for this item via the related product
     * @return mixed
     */
    public function getProductNameAttribute()
    {
        return $this->product->name;
    }
}
