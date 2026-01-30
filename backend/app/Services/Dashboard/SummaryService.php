<?php

namespace App\Services\Dashboard;

use App\Models\ParkingBook;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use App\Models\User;

class SummaryService
{
  public function getDashboardStats()
  {
    $totalUsers = User::where('role', 'user')->count();
    $activeBookings = ParkingBook::where('status', 'active')->count();

    $parkingLots = ParkingLot::with('parkingSpots')->get();
    $totalParkingLots = $parkingLots->count();

    $totalParkingSpots = ParkingSpot::count();

    $occupiedParkingSpots = ParkingSpot::whereIn('status', ['occupied', 'reserved'])->count();
    $brokenParkingSpots = ParkingSpot::where('status', 'broken')->count();

    $occupancyRate = $this->calculateRate($occupiedParkingSpots, $totalParkingSpots);
    $brokenRate = $this->calculateRate($brokenParkingSpots, $totalParkingSpots);
    $availableRate = $totalParkingSpots > 0
        ? round(100 - $occupancyRate - $brokenRate, 2)
        : 0;

    return [
        'totalUsers' => $totalUsers,
        'activeBookings' => $activeBookings,
        'totalParkingLots' => $totalParkingLots,
        'occupancyRate' => $occupancyRate,
        'availableRate' => $availableRate,
        'brokenRate' => $brokenRate,
        'lotOccupancy' => $parkingLots->map(function ($lot) {
            return [
                'name' => $lot->name,
                'available' => $lot->parkingSpots->where('status', 'available')->count(),
                'occupied' => $lot->parkingSpots->whereIn('status', ['occupied', 'reserved'])->count(),
                'broken' => $lot->parkingSpots->where('status', 'broken')->count(),
            ];
        }),
    ];
  }

  private function calculateRate(int $value, int $total): float
  {
    return $total > 0 ? round(($value / $total) * 100, 2) : 0;
  }
}
