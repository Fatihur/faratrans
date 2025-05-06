<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'returned' => 'boolean'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
