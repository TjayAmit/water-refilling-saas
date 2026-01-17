<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Database\Factories\OrderFactory;
use App\Enums\OrderStatusEnum;

/**
 * @property integer id
 * @property integer station_id
 * @property integer customer_id
 * @property string order_number
 * @property string order_date
 * @property float total_amount
 * @property PaymentMethodEnum payment_method
 * @property OrderStatusEnum status
 * @property string delivery_date
 * @property float latitude
 * @property float longitude
 * @property Customer customer
 */
class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'station_id',
        'customer_id',
        'order_number',
        'total_amount',
        'payment_method',
        'status',
        'delivery_date',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
        'total_amount' => 'decimal:2',
        'payment_method' => PaymentMethodEnum::class,
        'status' => OrderStatusEnum::class,
    ];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }
}
