<?php

namespace App\Http\Controllers\User\ParkingBook;

use App\Http\Controllers\Controller;
use App\Services\User\ParkingBookService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;

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
