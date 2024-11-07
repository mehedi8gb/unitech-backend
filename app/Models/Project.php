<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function floors() {
        return $this->hasMany(Floor::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

}
