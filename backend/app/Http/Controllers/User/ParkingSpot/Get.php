<?php

namespace App\Http\Controllers\User\ParkingSpot;

use App\Http\Controllers\Controller;
use App\Services\User\ParkingSpotService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;

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
