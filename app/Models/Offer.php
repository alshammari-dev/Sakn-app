<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Offer extends Model
{
    /** @use HasFactory<\Database\Factories\OfferFactory> */
    use HasFactory;

        protected $fillable = [
        'property_id', 'client_id', 'agent_id', 'offer_type',
        'offered_price', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return ['offered_price' => 'decimal:2'];
    }

    const STATUS_PENDING   = 'pending';
    const STATUS_ACCEPTED  = 'accepted';
    const STATUS_REJECTED  = 'rejected';
    const STATUS_CANCELLED = 'cancelled';

    public function isPending(): bool { return $this->status === self::STATUS_PENDING; }
    public function isAccepted(): bool { return $this->status === self::STATUS_ACCEPTED; }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function scopeFilter($query, $filters)
{
    return $query->when($filters['status'] ?? null, function ($q, $status) {
        $q->where('status', $status);
    })->when($filters['property_id'] ?? null, function ($q, $propertyId) {
        $q->where('property_id', $propertyId);
    })->when($filters['search'] ?? null, function ($q, $term) {
        $q->whereHas('property', fn($pq) => $pq->where('title', 'like', "%{$term}%"))
          ->orWhereHas('client', fn($cq) => $cq->where('name', 'like', "%{$term}%"));
    });
}
}
