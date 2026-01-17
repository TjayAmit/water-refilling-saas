<?php

namespace App\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property integer id
 * @property string name
 * @property string phone
 * @property boolean is_trusted
 * @property string notes
 * @property Station station
 * @property User user
 */
class Customer extends Model
{
    /** @use HasFactory<CustomerFactory> */
    use HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'is_trusted',
        'address'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_trusted' => 'boolean',
    ];
}
