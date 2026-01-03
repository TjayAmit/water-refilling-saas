<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyStat extends Model
{
    /** @use HasFactory<\Database\Factories\DailyStatFactory> */
    use HasFactory;

    protected $fillable = [
        'station_id',
        'date',
        'total_orders',
        'total_revenue',
        'total_deliveries',
    ];

    protected $casts = [
        'date' => 'date',
        'total_revenue' => 'decimal:2',
    ];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }
}
