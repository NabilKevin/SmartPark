<?php

namespace App\Http\Controllers\Dashboard\ParkingLot;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\ParkingLotService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;
  
/**
 * Get Parking Lots
 *
 * Mengambil daftar parking lot dengan pagination, filter, dan statistik.
 *
 * @group Parking Lot
 *
 * @queryParam perPage integer Jumlah data per halaman. Default: 10
 * @queryParam search string Pencarian berdasarkan nama parking lot.
 * @queryParam status string Filter status parking lot. Contoh: active, inactive
 *
 * @response 200 {
 *   "totalActiveLots": 3,
 *   "totalActiveCapacity": 120,
 *   "totalAvailableSpots": 45,
 *   "occupancyRate": 62.5,
 *   "activeLotWithAvailableSpace": 2,
 *   "activeLotWithFullyOccupied": 1,
 *   "parkingLots": {
 *     "current_page": 1,
 *     "data": [
 *       {
 *         "id": 1,
 *         "name": "Basement A",
 *         "capacity": 50,
 *         "available_spots": 20,
 *         "occupancy": 60
 *       }
 *     ]
 *   }
 * }
 */
  public function index(Request $request, ParkingLotService $parkingLotService)
  {
    try {
      $parkingLots = $parkingLotService->getAllParkingLots($request);
  
      return $this->respondSuccess('Parking lots retrieved successfully', $parkingLots, 200);
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error retrieving parking lots, please try again.', 500);
    }
  }

  /**
   * Get Parking Lots Only
   *
   * Mengambil daftar parking lot (tanpa statistik).
   *
   * @group Parking Lot
   *
   * @response 200 {
   *   "data": [
   *     {
   *       "id": 1,
   *       "name": "Basement A",
   *       "capacity": 50,
   *       "available_spots": 20,
   *       "occupancy": 60
   *     }
   *   ]
   * }
   */
  public function getParkingLotOnly(ParkingLotService $parkingLotService)
  {
    try {
      $parkingLots = $parkingLotService->getParkingLots();
  
      return $this->respondSuccess('Parking lots retrieved successfully', $parkingLots, 200);
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error retrieving parking lots, please try again.', 500);
    }
  }
}
