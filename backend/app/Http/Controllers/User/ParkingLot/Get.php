<?php

namespace App\Http\Controllers\User\ParkingLot;

use App\Http\Controllers\Controller;
use App\Services\User\ParkingLotService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;

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
