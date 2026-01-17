<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property integer id
 * @property string name
 * @property string email
 * @property string password
 * @property string two_factor_secret
 * @property string two_factor_recovery_codes
 * @property string remember_token
 * @property string email_verified_at
 * @property string two_factor_confirmed_at
 * @property Station station
 *
 * @method static find(int $id): User
 */
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    /**
     * Determine if the user can access a specific panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Check access based on the panel ID
        if ($panel->getId() === 'owner') {
            return $this->hasRole('owner'); // Spatie role check
        }

        if ($panel->getId() === 'admin') {
            return $this->hasRole('super_admin');
        }

        return true; // Default access for other panels
    }

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }
}
