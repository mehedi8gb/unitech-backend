<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public function units() {
        return $this->belongsToMany(Unit::class, 'agent_sales')
            ->withPivot('commission_earned')
            ->withTimestamps();
    }

}
