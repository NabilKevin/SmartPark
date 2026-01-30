<?php

namespace App\Services\User;

use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;

class ParkingSpotService
{
  public function getParkingSpots(Request $request, int $parkingLotId): array
  {
    $perPage = (int) $request->input('perPage', 10);
    $search  = $request->input('search');
    $status  = $request->input('status');

    $parkingLot = ParkingLot::findOrFail($parkingLotId);

    $query = ParkingSpot::where('parking_lot_id', $parkingLotId);

    if ($search) {
      $query->whereLike('spot_number', "%{$search}%");
    }

    if ($status) {
      $query->where('status', $status);
    }

    $summary = [
      'total'     => $parkingLot->capacity,
      'available' => $parkingLot->available_spots,
      'occupied'  => (clone $query)->where('status', 'occupied')->count(),
      'reserved'  => (clone $query)->where('status', 'reserved')->count(),
    ];

    return [
      'parkingSpots' => $query->paginate($perPage),
      'summary'      => $summary,
    ];
  }
}
