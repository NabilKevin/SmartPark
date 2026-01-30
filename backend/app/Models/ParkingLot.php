<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ParkingLot extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function parkingSpots()
    {
        return $this->hasMany(ParkingSpot::class);
    }

    protected static function booted()
    {
        static::deleting(function ($parkingLot) {
            DB::transaction(function () use ($parkingLot) {
                if ($parkingLot->isForceDeleting()) {
                    $parkingLot->parkingSpots()->forceDelete();
                } else {
                    $parkingLot->parkingSpots()->update(['status' => 'inactive', 'deactivated_reason' => $parkingLot->deactivated_reason]);
                    $parkingLot->parkingSpots()->delete();
                }
            });
        });

        static::restoring(function ($parkingLot) {
            DB::transaction(function () use ($parkingLot) {
                $parkingLot->parkingSpots()->withTrashed()->restore();
                $parkingLot->parkingSpots()->update(['status' => 'available']);
            });
        });
    }

}
