<?php

namespace App\Http\Controllers\Dashboard\ParkingLot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ParkingLot\UpdateRequest;
use App\Traits\ApiResponse;
use App\Services\Dashboard\ParkingLotService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Put extends Controller
{
  use ApiResponse;

  /**
 * Update Parking Lot
 *
 * Mengubah data parking lot (capacity dan/atau prefix).
 *
 * @group Parking Lot
 *
 * @urlParam id integer required ID parking lot.
 *
 * @bodyParam name string Nama baru parking lot.
 * @bodyParam capacity integer Kapasitas baru parking lot.
 * @bodyParam prefix string Prefix baru parking spot.
 *
 * @response 200 {
 *   "id": 1,
 *   "name": "Basement A",
 *   "capacity": 60,
 *   "available_spots": 30
 * }
 *
 * @response 400 {
 *   "message": "Cannot reduce capacity below number of occupied spots"
 * }
 */
  public function update(UpdateRequest $request, $id, ParkingLotService $parkingLotService)
  {
    $data = $request->validated();

    try {
      $parkingLot = $parkingLotService->updateParkingLot($data, $id);
  
      return $this->respondSuccess('Parking lot updated successfully', $parkingLot, 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking lot not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Throwable $e) {
        return $this->respondErrorWithoutData(
            'Error updating parking lot, please try again.' . $e->getMessage(),
            500
        );
    }
  }
}
