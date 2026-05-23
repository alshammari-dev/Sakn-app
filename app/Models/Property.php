<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory ;

    protected $fillable = [
        'added_by', 'title', 'ai_description', 'price',
        'city', 'district', 'lat', 'lng', 'status', 'is_archived',
    ];

    protected function casts(): array
    {
        return [
            'price'       => 'decimal:2',
            'lat'         => 'decimal:7',
            'lng'         => 'decimal:7',
            'is_archived' => 'boolean',
        ];
    }

    const STATUS_AVAILABLE         = 'available';
    const STATUS_UNDER_NEGOTIATION = 'under_negotiation';
    const STATUS_RESERVED          = 'reserved';
    const STATUS_SOLD              = 'sold';

    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE)->where('is_archived', false);
    }

    public function scopeNotArchived($query)
    {
        return $query->where('is_archived', false);
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->orderBy('sort_order');
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(PropertyImage::class)->where('is_main', true);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(PropertyDocument::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function saleApproval(): HasOne
    {
        return $this->hasOne(SaleApproval::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }


    public function syncStatus()
    {
        // 1. الحالة القصوى: إذا تم البيع، لا نغير شيئاً أبداً
        if ($this->status === 'sold') 
        {
            return;
        }

        // 2. فحص العرابين المقبولة (أعلى أولوية)
        // يتم حجز العقار فقط إذا تم قبول العربون رسمياً من الإدارة
        $hasApprovedDeposit = $this->deposits()
            ->where('status', 'approved')
            ->exists();

        if ($hasApprovedDeposit) {
            $this->update(['status' => self::STATUS_RESERVED]);
            return;
        }

        // 3. فحص الجدية (تحت التفاوض)
        // تشمل: عروض مقبولة أو معلقة، زيارات معتمدة، أو عربون معلق بانتظار الاعتماد
        $hasNegotiation = $this->offers()->whereIn('status', ['accepted', 'pending'])->exists() || 
                         $this->visits()->where('status', 'approved')->exists() ||
                         $this->deposits()->where('status', 'pending')->exists();

        if ($hasNegotiation) {
            $this->update(['status' => self::STATUS_UNDER_NEGOTIATION]);
            return;
        }

        // 4. إذا لم يجد شيئاً مما سبق
        $this->update(['status' => self::STATUS_AVAILABLE]);
    }
}
