<?php

namespace App\Http\Controllers\User\ParkingBook;

use App\Http\Controllers\Controller;
use App\Services\User\ParkingBookService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;

  /**
   * Get parking history
   *
   * Mengambil riwayat parkir user (booking & walk-in).
   * Mendukung pagination atau limit data terakhir.
   *
   * @group Parking Book
   * @authenticated
   *
   * @queryParam perPage integer Jumlah data per halaman. Default: 10
   * @queryParam limit integer Ambil data terakhir tanpa pagination. Contoh: 3
   *
   * @response 200 {
   *   "data": [
   *     {
   *       "id": 12,
   *       "status": "completed",
   *       "type": "walk_in",
   *       "booked_at": "2026-02-01 09:00:00",
   *       "checkin_at": "2026-02-01 09:05:00",
   *       "checked_at": "2026-02-01 11:00:00",
   *       "parking_spot": {
   *         "spot_number": "A001",
   *         "parking_lot": {
   *           "name": "Basement A"
   *         }
   *       }
   *     }
   *   ],
   *   "meta": {
   *     "current_page": 1,
   *     "last_page": 3,
   *     "per_page": 10,
   *     "total": 25
   *   }
   * }
   */
  public function getParkingHistories(Request $request, ParkingBookService $parkingBookService)
  {
    try {
        $data = $parkingBookService->getParkingHistory($request);

        return $this->respondSuccess('Successfully get parking history', $data, 200);
      } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
      } catch (\Exception $e) {
        return $this->respondErrorWithoutData('Error get parking history, please try again.', 500);
      }
  }
}
