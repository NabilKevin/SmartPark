<?php

namespace App\Services\Dashboard;

use App\Models\ParkingBook;
use App\Models\ParkingBookCancellation;
use App\Models\ParkingBookRelocation;
use App\Models\ParkingSpot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ParkingBookService
{
  public function getAllParkingBooks()
  {
    return ParkingBook::all();
  }

  public function createParkingBook(array $data)
  {
    return DB::transaction(function () use ($data) {
      $parkingSpot = ParkingSpot::findOrFail($data['parking_spot_id']);

      if ($parkingSpot->status !== 'available') {
        throw new RuntimeException('Parking spot is not available');
      }

      $parkingBook = ParkingBook::create([
          ...$data,
          'booked_at'    => now(),
          'expired_at'   => Carbon::parse($data['start_at'])->addMinutes(20),
          'booked_by'    => Auth::id(),
          'status'       => 'booked',
      ]);

      $parkingSpot->update(['status' => 'reserved']);

      return $parkingBook;
    });
  }

  public function cancelBooking(array $data)
  {
    return DB::transaction(function () use ($data) {
      $parkingBook = ParkingBook::findOrFail($data['parking_book_id']);
      $parkingSpot = ParkingSpot::findOrFail($parkingBook->parking_spot_id);

      if ($parkingBook->status !== 'booked') {
        throw new RuntimeException('Only booked parking books can be cancelled');
      }

      $bookingCancellation = ParkingBookCancellation::create([
        ...$data,
        'cancellation_type' => Auth::user()->role === 'user'
          ? 'user_cancelled'
          : 'admin_cancelled',
        'cancelled_by' => Auth::id(),
      ]);

      $parkingBook->update(['status' => 'cancelled']);
      $parkingSpot->update(['status' => 'available']);

      return $bookingCancellation;
    });
  }

  public function relocateBooking(array $data)
  {
    return DB::transaction(function () use ($data) {
      $parkingBook = ParkingBook::findOrFail($data['parking_book_id']);
      $oldSpot = ParkingSpot::findOrFail($parkingBook->parking_spot_id);
      $newSpot = ParkingSpot::findOrFail($data['to_parking_spot_id']);

      if ($parkingBook->status !== 'booked') {
        throw new RuntimeException('Only booked parking books can be relocated');
      }

      if ($oldSpot->id === $newSpot->id) {
        throw new RuntimeException('New parking spot must be different from the current one');
      }

      if ($newSpot->status !== 'available') {
        throw new RuntimeException('New parking spot is not available');
      }

      $previousRelocation = ParkingBookRelocation::where('parking_book_id', $parkingBook->id)
        ->where('status', 'active')
        ->first();

      if ($previousRelocation) {
          $previousRelocation->update([
            'status'        => 'reverted',
            'reverted_by'   => Auth::id(),
            'revert_reason' => $data['relocate_reason'],
            'reverted_at'   => now(),
          ]);
      }

      $relocation = ParkingBookRelocation::create([
        ...$data,
        'relocated_by'        => Auth::id(),
        'relocated_at'        => now(),
        'from_parking_spot_id'=> $oldSpot->id,
        'status'              => 'active',
      ]);

      $parkingBook->update(['parking_spot_id' => $newSpot->id]);
      $oldSpot->update(['status' => 'available']);
      $newSpot->update(['status' => 'reserved']);

      return $relocation;
    });
  }
}
