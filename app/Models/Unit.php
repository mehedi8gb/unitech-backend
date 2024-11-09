<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['floor_id', 'unit_number', 'size', 'price'];

    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class);
    }

    public function bookingStatus(): HasOne
    {
        return $this->hasOne(BookingStatus::class);
    }

    public function agentSales(): HasMany
    {
        return $this->hasMany(AgentSale::class);
    }

    /**
     * Get all images for the unit.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
