<?php

namespace App\Http\Controllers\Dashboard\ParkingSpot;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\ParkingSpotService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;
  
/**
 * Get Parking Spots
 *
 * Mengambil daftar parking spot dengan pagination, filter, dan ringkasan status.
 *
 * @group Parking Spot
 *
 * @queryParam perPage integer Jumlah data per halaman. Default: 10
 * @queryParam search string Pencarian berdasarkan nomor spot.
 * @queryParam lot integer Filter berdasarkan parking_lot_id.
 * @queryParam status string Filter status spot. Contoh: available, occupied, reserved, inactive
 *
 * @response 200 {
 *   "data": {
 *     "current_page": 1,
 *     "data": [
 *       {
 *         "id": 1,
 *         "spot_number": "A001",
 *         "status": "available",
 *         "parking_lot": {
 *           "id": 1,
 *           "name": "Basement A"
 *         }
 *       }
 *     ]
 *   },
 *   "summary": {
 *     "available": 12,
 *     "occupied": 8
 *   }
 * }
 */
  public function index(ParkingSpotService $parkingSpotService, Request $request)
  {
    try {
      $parkingSpots = $parkingSpotService->getAllParkingSpots($request);

      return $this->respondSuccess('Parking spots retrieved successfully', $parkingSpots, 200);
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error retrieving parking spots, please try again.', 500);
    }
  }
}
