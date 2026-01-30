<?php

namespace App\Http\Controllers\User\ParkingLot;

use App\Http\Controllers\Controller;
use App\Services\User\ParkingLotService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;

  /**
   * Get parking lots
   *
   * Mengambil daftar parking lot untuk user.
   * Mendukung pencarian, filter status, pagination, dan limit.
   *
   * @group Parking Lot (User)
   * @authenticated
   *
   * @queryParam search string Filter berdasarkan nama parking lot. Example: Basement
   * @queryParam status string Filter status parking lot. Enum: full, open. Example: open
   * @queryParam perPage integer Jumlah data per halaman (pagination). Default: 10. Example: 10
   * @queryParam limit integer Ambil data tanpa pagination (misalnya untuk homepage). Example: 3
   *
   * @response 200 {
   *   "data": [
   *     {
   *       "id": 1,
   *       "name": "Basement A",
   *       "capacity": 50,
   *       "available_spots": 10,
   *       "status": "active",
   *       "created_at": "2026-02-01 08:00:00"
   *     }
   *   ],
   *   "meta": {
   *     "current_page": 1,
   *     "last_page": 5,
   *     "per_page": 10,
   *     "total": 50
   *   }
   * }
   *
   * @response 200 [
   *   {
   *     "id": 1,
   *     "name": "Basement A",
   *     "capacity": 50,
   *     "available_spots": 10,
   *     "status": "active"
   *   }
   * ]
   */

  public function index(Request $request, ParkingLotService $parkingLotService)
  {
    try {
        $data = $parkingLotService->getParkingLots($request);

        return $this->respondSuccess('Successfully get parking lots', $data, 200);
      } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
      } catch (\Exception $e) {
        return $this->respondErrorWithoutData('Error get parking lots, please try again.', 500);
      }
  }
}
