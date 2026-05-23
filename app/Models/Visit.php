<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;


class Visit extends Model
{
    /** @use HasFactory<\Database\Factories\VisitFactory> */
    use HasFactory;

    protected $fillable = [
        'property_id', 'client_id', 'agent_id',
        'scheduled_at', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return ['scheduled_at' => 'datetime'];
    }

    const STATUS_PENDING   = 'pending';
    const STATUS_APPROVED  = 'approved';
    const STATUS_REJECTED  = 'rejected';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    public function isPending(): bool { return $this->status === self::STATUS_PENDING; }
    public function isApproved(): bool { return $this->status === self::STATUS_APPROVED; }

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

    // 1. سكوب لجلب الزيارات الخاصة بموظف معين (Dynamic Scope)
    public function scopeForAgent($query, $agentId)
    {
        if ($agentId) {
            return $query->where('agent_id', $agentId);
        }
    }

    // 2. سكوب لجلب الزيارات حسب الحالة
    public function scopeWithStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
    }

    // 3. سكوب البحث (المعقد اللي كتبناه قبل شوية)
    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->whereHas('property', function ($pq) use ($term) {
                    $pq->where('title', 'like', "%{$term}%");
                })->orWhereHas('client', function ($cq) use ($term) {
                    $cq->where('name', 'like', "%{$term}%");
                });
            });
        }
    }
}
