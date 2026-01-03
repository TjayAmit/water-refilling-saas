<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryRoute extends Model
{
    /** @use HasFactory<\Database\Factories\DeliveryRouteFactory> */
    use HasFactory;

    protected $fillable = [
        'station_id',
        'route_date',
        'optimized_data',
        'total_distance_km',
    ];

    protected $casts = [
        'route_date' => 'date',
        'optimized_data' => 'array',
        'total_distance_km' => 'decimal:2',
    ];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }
}
