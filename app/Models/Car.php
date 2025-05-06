<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function getFullNameAttribute()
    {
        return "{$this->brand} {$this->type} ({$this->license_plate})";
    }
}
