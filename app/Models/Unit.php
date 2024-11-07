<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function floor() {
        return $this->belongsTo(Floor::class);
    }

    public function bookingStatus() {
        return $this->belongsTo(BookingStatus::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function agents() {
        return $this->belongsToMany(Agent::class, 'agent_sales')
            ->withPivot('commission_earned')
            ->withTimestamps();
    }

}
