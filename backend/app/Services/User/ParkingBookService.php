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
    public function createParkingBook(array $data)
    {
        $userId = Auth::id();

        $parkingSpot = ParkingSpot::findOrFail($data['parking_spot_id']);
        $parkingLot  = ParkingLot::findOrFail($parkingSpot->parking_lot_id);

        if ($parkingSpot->status !== 'available') {
            throw new RuntimeException('Parking spot is not available');
        }

        if ($data['type'] === 'walk_in') {
            return $this->handleWalkIn($data, $userId, $parkingSpot, $parkingLot);
        }

        return $this->handleBooking($data, $userId, $parkingSpot, $parkingLot);
    }

    private function handleWalkIn($data, $userId, $parkingSpot, $parkingLot)
    {
        $today = Carbon::today();

        $alreadyBooked = ParkingBook::where('user_id', $userId)
            ->whereIn('status', ['booked', 'active'])
            ->where(function ($q) use ($today) {
                $q->whereDate('start_at', $today)
                  ->orWhereDate('checkin_at', $today);
            })
            ->exists();

        if ($alreadyBooked) {
            throw new RuntimeException('You already booked or parked today!');
        }

        $parkingSpot->update(['status' => 'occupied']);
        $parkingLot->decrement('available_spots');

        return ParkingBook::create([
            ...$data,
            'user_id'    => $userId,
            'booked_by'  => $userId,
            'booked_at'  => now(),
            'checkin_at' => now(),
            'status'     => 'active',
        ]);
    }

    private function handleBooking($data, $userId, $parkingSpot, $parkingLot)
    {
        $startDate = Carbon::parse($data['start_at'])->toDateString();

        $alreadyBooked = ParkingBook::where('user_id', $userId)
            ->whereIn('status', ['booked', 'active'])
            ->whereDate('start_at', $startDate)
            ->exists();

        if ($alreadyBooked) {
            throw new RuntimeException('You already booked on that day!');
        }

        $parkingSpot->update(['status' => 'reserved']);
        $parkingLot->decrement('available_spots');

        return ParkingBook::create([
            ...$data,
            'user_id'    => $userId,
            'booked_by'  => $userId,
            'booked_at'  => now(),
            'expired_at' => Carbon::parse($data['start_at'])->addMinutes(20),
            'status'     => 'booked',
        ]);
    }

    public function getParkingHistory($request)
    {
        $userId  = Auth::id();
        $perPage = $request->input('perPage', 10);
        $limit   = $request->input('limit');

        $query = ParkingBook::with('parkingSpot.parkingLot')
            ->where('user_id', $userId)
            ->latest();

        if ($limit) {
            return GetParkingBookResource::collection(
                $query->limit($limit)->get()
            );
        }

        return GetParkingBookResource::collection(
            $query->paginate($perPage)
        )->response()->getData(true);
    }

    public function checkout(int $id)
    {
        $parkingBook = ParkingBook::findOrFail($id);

        if ($parkingBook->status !== 'active') {
            throw new RuntimeException('You already checked out or booking is inactive');
        }

        $parkingSpot = ParkingSpot::findOrFail($parkingBook->parking_spot_id);
        $parkingLot  = ParkingLot::findOrFail($parkingSpot->parking_lot_id);

        $parkingBook->update([
            'status'     => 'completed',
            'checkout_at' => now(),
        ]);

        $parkingSpot->update(['status' => 'available']);
        $parkingLot->increment('available_spots');

        return $parkingBook;
    }
}
