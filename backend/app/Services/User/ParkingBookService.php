<?php

namespace App\Services\User;

use App\Http\Resources\GetParkingBookResource;
use App\Models\ParkingBook;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

class ParkingBookService
{
  public function createParkingBook($data)
  {
    $user_id = Auth::id();

    $parkingSpot = ParkingSpot::findOrFail($data['parking_spot_id']);
    $parkingLot = ParkingLot::findOrFail($parkingSpot->parking_lot_id);

    if ($parkingSpot->status !== 'available') {
      throw new RuntimeException('Parking spot is not available');
    }

    if($data['type'] === 'walk_in') {
      $parkingBook = ParkingBook::whereDate('start_at', Carbon::today()->toDateString())->orWhereDate('checkin_at', Carbon::today()->toDateString())->where('user_id', $user_id)->whereIn('status', ['booked', 'active'])->first();
      if($parkingBook) {
        throw new RuntimeException('You already booked or park today!');
      }

      $data['checkin_at'] = Carbon::now();
      $data['status'] = 'active';
      $parkingSpot->update(['status' => 'occupied']);
    } else {
      $parkingBook = ParkingBook::where('user_id', $user_id)->whereIn('status', ['booked', 'active'])->whereDate('start_at', Carbon::parse($data['start_at'])->toDateString())->first();
      if($parkingBook) {
        throw new RuntimeException('You already booked on that day!');
      }

      $data['status'] = 'booked';
      $data['expired_at'] = Carbon::parse($data['start_at'])->addMinutes(20);
      $parkingSpot->update(['status' => 'reserved']);
    }

    $parkingLot->update(['available_spots' => $parkingLot->available_spots - 1]);

    return ParkingBook::create([
      ...$data,
      'user_id' => $user_id,
      'booked_by' => $user_id,
      'booked_at' => Carbon::now()
    ]);
  }

  public function getParkingHistory($request)
  {
    $perPage = $request->input('perPage', 10);
    $limit = $request->input('limit', '');

    $user_id = Auth::id();
    
    $parkingBooks = ParkingBook::with(['parkingSpot.parkingLot'])->where('user_id', $user_id);
    if(!empty($limit)) {
      return GetParkingBookResource::collection($parkingBooks->limit($limit)->get());
    }

    return GetParkingBookResource::collection($parkingBooks->paginate($perPage))->response()->getData(true);
  }

  public function checkout($id) {
    $parkingBook = ParkingBook::findOrFail($id);
    $parkingSpot = ParkingSpot::findOrFail($parkingBook->parking_spot_id);
    $parkingLot = ParkingLot::findOrFail($parkingSpot->parking_lot_id);

    if($parkingBook->status !== 'active') {
      throw new RuntimeException('You already checked out or book cancelled');
    }

    $parkingBook->update(['status' => 'completed', 'checked_at' => Carbon::now()->format('Y-m-d H:i:s')]);
    $parkingSpot->update(['status' => 'available']);
    $parkingLot->update(['available_spots' => $parkingLot->available_spots + 1]);

    return $parkingBook;
  }
}