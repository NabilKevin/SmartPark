<?php

namespace App\Http\Controllers\Dashboard\Summary;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\SummaryService;
use App\Traits\ApiResponse;

class Get extends Controller
{
  use ApiResponse;
  
  /**
 * Dashboard Summary
 *
 * Mengambil ringkasan data dashboard seperti:
 * - Total user
 * - Jumlah booking aktif
 * - Statistik parking lot & parking spot
 * - Persentase okupansi, tersedia, dan rusak
 *
 * @group Dashboard
 *
 * @authenticated
 *
 * @response 200 {
 *   "status": true,
 *   "message": "Dashboard summary retrieved successfully",
 *   "data": {
 *     "totalUsers": 120,
 *     "activeBookings": 15,
 *     "totalParkingLots": 3,
 *     "occupancyRate": 45.5,
 *     "availableRate": 48.0,
 *     "brokenRate": 6.5,
 *     "lotOccupancy": [
 *       {
 *         "name": "Basement A",
 *         "available": 20,
 *         "occupied": 25,
 *         "broken": 5
 *       },
 *       {
 *         "name": "Outdoor Area",
 *         "available": 10,
 *         "occupied": 8,
 *         "broken": 2
 *       }
 *     ]
 *   }
 * }
 *
 * @response 401 {
 *   "message": "Unauthenticated."
 * }
 */
  public function index(SummaryService $summaryService)
  {
    try {
      $dashboardStats = $summaryService->getDashboardStats();

      return $this->respondSuccess('Dashboard stats retrieved successfully', $dashboardStats, 200);
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error retrieving dashboard stats, please try again.', 500);
    }
  }
}
