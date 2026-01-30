<?php

namespace App\Services\User;

use App\Models\ParkingLot;
use App\Models\ParkingSpot;

class ParkingSpotService
{
  public function getParkingSpots($request, $id)
  {
    $perPage = $request->input('perPage', 10);
    $search = $request->input('search', '');
    $filterByStatus = $request->input('status', '');
    
    $parkingLot = ParkingLot::findOrFail($id);
    $parkingSpots = ParkingSpot::where('parking_lot_id', $id)->whereLike('spot_number', "%$search%");

    if($filterByStatus !== '' && $filterByStatus) {
      $parkingSpots = $parkingSpots->where('status', $filterByStatus);
    }

    $summary = [
      'total' => $parkingLot->capacity,
      'available' => $parkingLot->available_spots,
      'occupied' => (clone $parkingSpots)->where('status', 'occupied')->count(),
      'reserved' => (clone $parkingSpots)->where('status', 'reserved')->count(),
    ];   

    $parkingSpots = $parkingSpots->paginate($perPage);

    return [
      'parkingSpot' => $parkingSpots,
      'summary' => $summary
    ];
  }
}
