<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PropertyDocument extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyDocumentFactory> */
    use HasFactory;

    protected $fillable = ['property_id', 'doc_type', 'file_url', 'is_private'];

    protected function casts(): array
    {
        return ['is_private' => 'boolean'];
    }

    const TYPE_OWNERSHIP_DEED = 'ownership_deed';
    const TYPE_FLOOR_PLAN     = 'floor_plan';
    const TYPE_OTHER          = 'other';

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
