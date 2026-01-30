<?php

namespace App\Http\Controllers\Dashboard\ParkingBook;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\ParkingBookService;
use App\Traits\ApiResponse;

class Get extends Controller
{
  use ApiResponse;
  
  /**
   * Get all parking books
   *
   * @group Parking Book
   * @authenticated
   *
   * @response 200 [
   *  {
   *    "id": 1,
   *    "parking_spot_id": 3,
   *    "status": "booked"
   *  }
   * ]
   */
  public function index(ParkingBookService $parkingBookService)
  {
    try {
      $data = $parkingBookService->getAllParkingBooks();
      return $this->respondSuccess('Parking books retrieved successfully', $data, 200);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Failed to retrieve parking books', 500);
    }
  }
}
