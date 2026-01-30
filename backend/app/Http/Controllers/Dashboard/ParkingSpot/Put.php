<?php

namespace App\Http\Controllers\Dashboard\ParkingSpot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ParkingSpot\UpdateRequest;
use App\Services\Dashboard\ParkingSpotService;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Put extends Controller
{
  use ApiResponse;

  /**
   * Update Parking Spot
   *
   * Mengubah data parking spot.
   *
   * @group Parking Spot
   *
   * @urlParam id integer required ID parking spot.
   *
   * @bodyParam status string Status baru. Contoh: available, occupied, reserved
   * @bodyParam number integer Nomor baru spot (tanpa prefix).
   *
   * @response 200 {
   *   "id": 1,
   *   "spot_number": "A015",
   *   "status": "occupied"
   * }
   *
   * @response 400 {
   *   "message": "Parking spot A015 already exists in this parking lot"
   * }
   */
  public function update(UpdateRequest $request, $id, ParkingSpotService $parkingSpotService)
  {
    $data = $request->validated();

    try {
      $parkingSpot = $parkingSpotService->updateParkingSpot($data, $id);

      return $this->respondSuccess('Parking spot updated successfully', $parkingSpot, 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking spot not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Throwable $e) {
        return $this->respondErrorWithoutData(
            'Error updating parking spot, please try again.' . $e->getMessage(),
            500
        );
    }
  }
}
