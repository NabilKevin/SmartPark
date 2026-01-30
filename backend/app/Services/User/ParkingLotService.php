<?php

namespace App\Services\User;

use App\Models\ParkingLot;

class ParkingLotService
{
  public function getParkingLots($request)
  {
    $perPage = $request->input('perPage', 10);
    $search = $request->input('search', '');
    $status = $request->input('status', '');
    $limit = $request->input('limit', '');
    
    $parkingLots = ParkingLot::whereLike('name', "%$search%");

    if(!empty($limit)) {
      return $parkingLots->limit($limit)->get();
    }
    if(!empty($status)) {
      if($status === 'full') {
        $parkingLots->where('available_spots', 0);
      } else {
        $parkingLots->whereNot('available_spots', 0);
      }
    }

    return $parkingLots->paginate($perPage);
  }
}