<?php

namespace App\Services\Dashboard;

use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class ParkingLotService
{
  public function createParkingLot(array $data)
  {
    return DB::transaction(function () use ($data) {
      $parkingLot = ParkingLot::create([
          ...$data,
          'available_spots' => $data['capacity'],
          'prefix' => Str::upper($data['prefix']),
      ]);

      $spots = collect(range(1, $data['capacity']))->map(fn ($i) => [
          'parking_lot_id' => $parkingLot->id,
          'spot_number'    => $parkingLot->prefix . str_pad($i, 3, '0', STR_PAD_LEFT),
          'status'         => 'available',
          'created_at'     => now(),
          'updated_at'     => now(),
      ])->toArray();

      ParkingSpot::insert($spots);

      return $parkingLot;
    });
  }

  public function updateParkingLot(array $data, $id)
  {
      $parkingLot = ParkingLot::with('parkingSpots')->findOrFail($id);

      return DB::transaction(function () use ($data, $parkingLot) {
          if (array_key_exists('capacity', $data)) {
              $this->handleCapacityChange($parkingLot, $data);
          }

          if (array_key_exists('prefix', $data)) {
              $this->handlePrefixChange($parkingLot, $data);
          }

          $parkingLot->update($data);

          return $parkingLot;
      });
  }

  private function handleCapacityChange(ParkingLot $parkingLot, array &$data): void
  {
      if ($data['capacity'] < $parkingLot->capacity) {
          $occupiedCount = $parkingLot->parkingSpots()
              ->whereIn('status', ['occupied', 'reserved'])
              ->count();

          if ($data['capacity'] < $occupiedCount) {
              throw new RuntimeException(
                  'Cannot reduce capacity below number of occupied spots',
                  400
              );
          }

          $removeCount = $parkingLot->capacity - $data['capacity'];

          $spots = $parkingLot->parkingSpots()
              ->whereIn('status', ['available', 'broken'])
              ->orderByRaw("FIELD(status, 'broken', 'available')")
              ->orderByDesc('spot_number')
              ->take($removeCount)
              ->get();

          $availableRemoved = 0;

          foreach ($spots as $spot) {
              if ($spot->status === 'available') {
                  $availableRemoved++;
              }
              $spot->delete();
          }

          $data['available_spots'] = $parkingLot->available_spots - $availableRemoved;
      }

      if ($data['capacity'] > $parkingLot->capacity) {
          $addCount = $data['capacity'] - $parkingLot->capacity;
          $currentCount = $parkingLot->parkingSpots()->count();
          $prefix = $data['prefix'] ?? $parkingLot->prefix;

          for ($i = 1; $i <= $addCount; $i++) {
              ParkingSpot::create([
                  'parking_lot_id' => $parkingLot->id,
                  'spot_number' => $prefix . str_pad($currentCount + $i, 3, '0', STR_PAD_LEFT),
                  'status' => 'available',
              ]);
          }

          $data['available_spots'] = $parkingLot->available_spots + $addCount;
      }
  }

  private function handlePrefixChange(ParkingLot $parkingLot, array &$data): void
  {
      $data['prefix'] = Str::upper($data['prefix']);

      if ($data['prefix'] === $parkingLot->prefix) {
          return;
      }

      $parkingLot->parkingSpots->each(function ($spot) use ($data) {
          $spot->spot_number = preg_replace('/^\D+/', $data['prefix'], $spot->spot_number);
          $spot->save();
      });
  }

  public function deleteParkingLot($id, $data)
  {
      return DB::transaction(function () use ($id, $data) {
          $parkingLot = ParkingLot::findOrFail($id);

          if ($parkingLot->status === 'inactive') {
              throw new RuntimeException('Parking lot is already inactive', 400);
          }

          if ($parkingLot->parkingSpots()
              ->whereIn('status', ['occupied', 'reserved'])
              ->exists()) {
              throw new RuntimeException(
                  'Cannot deactive lot with occupied or reserved spots',
                  400
              );
          }

          $parkingLot->update([
              ...$data,
              'status' => 'inactive',
              'available_spots' => 0,
          ]);

          return $parkingLot->delete();
      });
  }

  public function getParkingLots()
  {
      return ParkingLot::withTrashed()->get();
  }

  public function getAllParkingLots($request)
  {
      $perPage = $request->input('perPage', 10);
      $search = $request->input('search', '');
      $status = $request->input('status', '');

      $baseQuery = ParkingLot::withTrashed()
          ->with(['parkingSpots' => fn ($q) => $q->withTrashed()])
          ->whereLike('name', "%$search%");

      if ($status !== '') {
          $baseQuery->where('status', $status);
      }

      $allLots = $baseQuery->get();
      $activeLots = $allLots->where('status', 'active');

      $totalSpots = $activeLots->sum(fn ($lot) => $lot->parkingSpots->count());
      $occupiedSpots = $activeLots->sum(
          fn ($lot) => $lot->parkingSpots
              ->whereIn('status', ['reserved', 'occupied'])
              ->count()
      );

      $parkingLots = (clone $baseQuery)
          ->paginate($perPage)
          ->through(function ($lot) {
              $lot->occupancy = round(
                  $lot->parkingSpots
                      ->whereIn('status', ['reserved', 'occupied'])
                      ->count()
                  / max(1, $lot->capacity) * 100,
                  2
              );

              return $lot;
          });

      return [
          'totalActiveLots' => $activeLots->count(),
          'totalActiveCapacity' => $activeLots->sum('capacity'),
          'totalAvailableSpots' => $activeLots->sum(
              fn ($lot) => $lot->parkingSpots->where('status', 'available')->count()
          ),
          'occupancyRate' => round($occupiedSpots / max(1, $totalSpots) * 100, 2),
          'activeLotWithAvailableSpace' => $activeLots->filter(
              fn ($lot) => $lot->parkingSpots->where('status', 'available')->count() > 0
          )->count(),
          'activeLotWithFullyOccupied' => $activeLots->filter(
              fn ($lot) => $lot->parkingSpots->where('status', 'available')->count() === 0
          )->count(),
          'parkingLots' => $parkingLots,
      ];
  }

  public function activateParkingLot($id)
  {
    $parkingLot = ParkingLot::withTrashed()->findOrFail($id);

    if ($parkingLot->status === 'active') {
        throw new RuntimeException('Parking lot is already active', 400);
    }

    if ($parkingLot->trashed()) {
        $parkingLot->restore();
    }

    $parkingLot->update([
        'status' => 'active',
        'available_spots' => $parkingLot->capacity,
    ]);

    return $parkingLot;
  }
}
