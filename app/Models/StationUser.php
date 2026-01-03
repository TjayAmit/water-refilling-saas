<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StationUser extends Model
{
    /** @use HasFactory<\Database\Factories\StationUserFactory> */
    use HasFactory;

    protected $fillable = [
        'station_id',
        'name',
        'role',
        'phone',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }
}
