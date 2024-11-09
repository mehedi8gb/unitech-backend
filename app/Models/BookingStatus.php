<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingStatus extends Model
{
    protected $fillable = ['unit_id', 'status_name', 'color_code'];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
