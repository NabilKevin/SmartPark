<?php

namespace App\Http\Controllers\User\ParkingSpot;

use App\Http\Controllers\Controller;
use App\Services\User\ParkingSpotService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;

  /**
   * Get parking spots by parking lot
   *
   * Mengambil daftar parking spot berdasarkan parking lot tertentu,
   * dilengkapi dengan summary ketersediaan spot.
   *
   * @group Parking Spot (User)
   * @authenticated
   *
   * @urlParam id integer required ID parking lot. Example: 1
   *
   * @queryParam search string Filter berdasarkan nomor spot. Example: A01
   * @queryParam status string Filter status parking spot. Enum: available, occupied, reserved, broken. Example: available
   * @queryParam perPage integer Jumlah data per halaman. Default: 10. Example: 10
   *
   * @response 200 {
   *   "parkingSpots": {
   *     "data": [
   *       {
   *         "id": 1,
   *         "parking_lot_id": 1,
   *         "spot_number": "A001",
   *         "status": "available",
   *         "created_at": "2026-02-01 08:00:00"
   *       }
   *     ],
   *     "meta": {
   *       "current_page": 1,
   *       "last_page": 3,
   *       "per_page": 10,
   *       "total": 25
   *     }
   *   },
   *   "summary": {
   *     "total": 30,
   *     "available": 10,
   *     "occupied": 15,
   *     "reserved": 5
   *   }
   * }
   *
   * @response 404 {
   *   "success": false,
   *   "message": "Parking lot not found"
   * }
   */

  public function index(Request $request, ParkingSpotService $parkingLotService, $id)
  {
    try {
        $data = $parkingLotService->getParkingSpots($request, $id);

        return $this->respondSuccess('Successfully get parking spots', $data, 200);
      } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
      } catch (\Exception $e) {
        return $this->respondErrorWithoutData('Error get parking spots, please try again.', 500);
      }
  }
}
