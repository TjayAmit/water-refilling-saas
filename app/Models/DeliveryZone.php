<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryZone extends Model
{
    /** @use HasFactory<\Database\Factories\DeliveryZoneFactory> */
    use HasFactory;

    protected $fillable = [
        'station_id',
        'type',
        'radius_km',
        'polygon',
        'is_active',
    ];

    protected $casts = [
        'radius_km' => 'decimal:2',
        'polygon' => 'array',
        'is_active' => 'boolean',
    ];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }
}
