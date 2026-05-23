<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;
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
        ];
    }

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isAgent(): bool { return $this->role === 'sale-agent'; }
    public function isClient(): bool { return $this->role === 'client'; }
    public function isContentManager(): bool { return $this->role === 'content manager'; }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'added_by');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'client_id');
    }

    public function managedOffers(): HasMany
    {
        return $this->hasMany(Offer::class, 'agent_id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'client_id');
    }

    public function managedVisits(): HasMany
    {
        return $this->hasMany(Visit::class, 'agent_id');
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class, 'client_id');
    }

    public function approvedDeposits(): HasMany
    {
        return $this->hasMany(Deposit::class, 'approved_by');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'client_id');
    }
}
