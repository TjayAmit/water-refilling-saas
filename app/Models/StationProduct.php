<?php

namespace App\Models;

use Database\Factories\StationProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StationProduct extends Model
{
    /** @use HasFactory<StationProductFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'station_id',
        'product_id',
        'price',
        'is_active',
        'quantity',
        'has_stock_limit',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'has_stock_limit' => 'boolean',
    ];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
