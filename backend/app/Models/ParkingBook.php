<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingBook extends Model
{
    protected $guarded = ['id'];

    public function parkingSpot()
    {
        return $this->belongsTo(ParkingSpot::class);
    }
}
