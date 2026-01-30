<?php

namespace App\Services\Dashboard;

use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParkingSpotService
{
  public function deleteParkingSpot($id, $data)
  {
      return DB::transaction(function () use ($id, $data) {
          $spot = ParkingSpot::findOrFail($id);

          $this->ensureSpotCanBeDeactivated($spot);

          $lot = $spot->parkingLot;

          if ($spot->status === 'available') {
              $this->decreaseLotCapacity($lot);
          }

          $spot->update(['status' => 'inactive'] + $data);

          return $spot->delete();
      });
  }

  public function activateParkingSpot($id)
  {
      return DB::transaction(function () use ($id) {
          $spot = ParkingSpot::withTrashed()->with(['parkingLot' => fn ($q) => $q->withTrashed()])->findOrFail($id);
          $lot = $spot->parkingLot;

          if ($lot->status === 'inactive') {
              throw new \RuntimeException(
                  'Cannot restore parking spot because its parking lot is inactive',
                  400
              );
          }

          if ($spot->status !== 'inactive') {
              throw new \RuntimeException('Parking spot is already active', 400);
          }

          $spot->restore();
          $spot->update(['status' => 'available']);

          $this->increaseLotCapacity($lot);

          return $spot;
      });
  }

  public function createParkingSpot(array $data)
  {
      return DB::transaction(function () use ($data) {
          $lot = ParkingLot::findOrFail($data['parking_lot_id']);

          if ($lot->status === 'inactive') {
              throw new \RuntimeException(
                  'Cannot add parking spot to an inactive parking lot',
                  400
              );
          }

          $createdSpots = [];

          if (array_key_exists('custom_number', $data)) {
              $createdSpots = $this->createCustomSpots($lot, $data['custom_number']);
          }

          if (
              array_key_exists('start_number', $data) &&
              array_key_exists('amount', $data)
          ) {
              [$createdSpots, $alert] = $this->createRangeSpots(
                  $lot,
                  $data['start_number'],
                  $data['amount']
              );
          }

          $this->increaseLotCapacity($lot, count($createdSpots));

          if (isset($alert)) {
              return ['spots' => $createdSpots, 'alert' => $alert];
          }

          return ['spots' => $createdSpots];
      });
  }

  public function getAllParkingSpots($request)
  {
      $perPage = $request->input('perPage', 10);
      $search  = $request->input('search', '');
      $lotId   = $request->input('lot');
      $status  = $request->input('status');

      $query = ParkingSpot::withTrashed()
          ->with(['parkingLot' => fn ($q) => $q->withTrashed()])
          ->whereLike('spot_number', "%{$search}%");

      if ($lotId) {
          $query->where('parking_lot_id', $lotId);
      }

      if ($status) {
          $query->where('status', Str::lower($status));
      }

      $available = (clone $query)->where('status', 'available')->count();
      $occupied  = (clone $query)
          ->whereIn('status', ['occupied', 'reserved'])
          ->count();

      return [
          'data' => $query->paginate($perPage),
          'summary' => [
              'available' => $available,
              'occupied' => $occupied,
          ],
      ];
  }

  public function updateParkingSpot(array $data, $id)
  {
      return DB::transaction(function () use ($data, $id) {
          $spot = ParkingSpot::findOrFail($id);
          $lot  = $spot->parkingLot;

          $this->handleStatusChange($spot, $lot, $data);
          $this->handleNumberChange($spot, $data);

          $spot->update($data);

          return $spot;
      });
  }

  private function ensureSpotCanBeDeactivated(ParkingSpot $spot): void
  {
      if (in_array($spot->status, ['occupied', 'reserved'])) {
          throw new \RuntimeException(
              'Only available or broken parking spots can be deactived',
              400
          );
      }

      if ($spot->status === 'inactive') {
          throw new \RuntimeException('Parking spot is already inactive', 400);
      }
  }

  private function increaseLotCapacity(ParkingLot $lot, int $amount = 1): void
  {
      $lot->increment('capacity', $amount);
      $lot->increment('available_spots', $amount);
  }

  private function decreaseLotCapacity(ParkingLot $lot): void
  {
      $lot->capacity = max(0, $lot->capacity - 1);
      $lot->available_spots = max(0, $lot->available_spots - 1);
      $lot->save();
  }

  private function createCustomSpots(ParkingLot $lot, array $numbers): array
  {
      $spots = [];

      foreach ($numbers as $number) {
          $spotNumber = $this->formatSpotNumber($lot, $number);

          if ($lot->parkingSpots()->where('spot_number', $spotNumber)->exists()) {
              throw new \RuntimeException(
                  "Parking spot {$spotNumber} already exists in this parking lot",
                  400
              );
          }

          $spots[] = ParkingSpot::create([
              'parking_lot_id' => $lot->id,
              'spot_number' => $spotNumber,
              'status' => 'available',
          ]);
      }

      return $spots;
  }

  private function createRangeSpots(ParkingLot $lot, int $start, int $amount): array
  {
      $existing = $lot->parkingSpots()->pluck('spot_number')->toArray();
      $created  = [];
      $skipped  = [];
      $maxSkip  = min($amount * 0.1, 100);

      for ($i = 0; $i < $amount + count($skipped); $i++) {
          $spotNumber = $this->formatSpotNumber($lot, $start + $i);

          if (in_array($spotNumber, $existing)) {
              $skipped[] = $spotNumber;

              if (count($skipped) > $maxSkip) {
                  throw new \RuntimeException(
                      "Too many existing parking spots found while creating spots. Created "
                      . count($created) . " spots before aborting.",
                      400
                  );
              }

              continue;
          }

          $created[] = ParkingSpot::create([
              'parking_lot_id' => $lot->id,
              'spot_number' => $spotNumber,
              'status' => 'available',
          ]);
      }

      $alert = count($skipped)
          ? 'Skipped existing parking spots: ' . implode(', ', $skipped)
          : null;

      return [$created, $alert];
  }

  private function handleStatusChange(ParkingSpot $spot, ParkingLot $lot, array &$data): void
  {
      if (!array_key_exists('status', $data)) {
          return;
      }

      if ($data['status'] === 'inactive') {
          throw new \RuntimeException(
              'Use deleteParkingSpot method to deactivate a parking spot',
              400
          );
      }

      if ($spot->status === 'inactive' && $data['status'] === 'available') {
          throw new \RuntimeException(
              'Use Activate Parking Spot method to activate a parking spot',
              400
          );
      }

      if ($data['status'] !== 'available') {
          $lot->available_spots = max(0, $lot->available_spots - 1);
          $lot->save();
      }
  }

  private function handleNumberChange(ParkingSpot $spot, array &$data): void
  {
      if (!array_key_exists('number', $data)) {
          return;
      }

      $newNumber = $this->formatSpotNumber($spot->parkingLot, $data['number']);

      if (
          $newNumber !== $spot->spot_number &&
          $spot->parkingLot->parkingSpots()
              ->where('spot_number', $newNumber)
              ->exists()
      ) {
          throw new \RuntimeException(
              "Parking spot {$newNumber} already exists in this parking lot",
              400
          );
      }

      $data['spot_number'] = $newNumber;
      unset($data['number']);
  }

  private function formatSpotNumber(ParkingLot $lot, int $number): string
  {
      return $lot->prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
  }
}
