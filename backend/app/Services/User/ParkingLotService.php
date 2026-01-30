<?php

namespace App\Services\User;

use App\Models\ParkingLot;
use Illuminate\Http\Request;

class ParkingLotService
{
  public function getParkingLots(Request $request)
  {
    $perPage = (int) $request->input('perPage', 10);
    $search  = $request->input('search');
    $status  = $request->input('status');
    $limit   = $request->input('limit');

    $query = ParkingLot::query();

    if ($search) {
      $query->whereLike('name', "%{$search}%");
    }

    if ($status) {
      match ($status) {
        'full'  => $query->where('available_spots', 0),
        'open'  => $query->where('available_spots', '>', 0),
        default => null,
      };
    }

    if ($limit) {
      return $query->limit((int) $limit)->get();
    }

    return $query->paginate($perPage);
  }
}
