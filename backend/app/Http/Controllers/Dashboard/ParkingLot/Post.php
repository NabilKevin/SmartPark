<?php

namespace App\Http\Controllers\Dashboard\ParkingLot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ParkingLot\DeactivateRequestRequest;
use App\Http\Requests\Dashboard\ParkingLot\DectivateLotRequest;
use App\Http\Requests\Dashboard\ParkingLot\StoreRequest;
use App\Services\Dashboard\ParkingLotService;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post extends Controller
{
  use ApiResponse;

  /**
 * Create Parking Lot
 *
 * Membuat parking lot baru beserta parking spots otomatis.
 *
 * @group Parking Lot
 *
 * @bodyParam name string required Nama parking lot.
 * @bodyParam capacity integer required Kapasitas parking lot.
 * @bodyParam prefix string required Prefix kode spot. Contoh: A, B1
 *
 * @response 201 {
 *   "id": 1,
 *   "name": "Basement A",
 *   "capacity": 50,
 *   "available_spots": 50,
 *   "prefix": "A"
 * }
 *
 * @response 400 {
 *   "message": "Validation error"
 * }
 */
  public function store(StoreRequest $request, ParkingLotService $parkingLotService)
  {
    $data = $request->validated();

    try {
      $parkingLot = $parkingLotService->createParkingLot($data);
  
      return $this->respondSuccess('Parking lot created successfully', $parkingLot, 200);
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error creating parking lot, please try again.', 500);
    }
  }

  /**
   * Activate Parking Lot
   *
   * Mengaktifkan kembali parking lot yang nonaktif.
   *
   * @group Parking Lot
   *
   * @urlParam id integer required ID parking lot.
   *
   * @response 200 {
   *   "message": "Parking lot activated successfully"
   * }
   *
   * @response 400 {
   *   "message": "Parking lot is already active"
   * }
   */
  public function activateParkingLot($id, ParkingLotService $parkingLotService)
  {
    try {
      $parkingLot = $parkingLotService->activateParkingLot($id);
  
      return $this->respondSuccessWithoutData('Parking lot activated successfully', 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking lot not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error activating parking lot, please try again.', 500);
    }
  }

  /**
   * Delete Parking Lot
   *
   * Menonaktifkan parking lot (soft delete).
   *
   * @group Parking Lot
   *
   * @urlParam id integer required ID parking lot.
   *
   * @response 200 {
   *   "message": "Parking lot deactivated successfully"
   * }
   *
   * @response 400 {
   *   "message": "Cannot delete parking lot with occupied or reserved spots"
   * }
   */
  public function deactivateParkingLot(DectivateLotRequest $request, $id, ParkingLotService $parkingLotService)
  {
    $data = $request->validated();
    try {
      $parkingLotService->deleteParkingLot($id, $data);

      return $this->respondSuccessWithoutData('Parking lot deactivated successfully', 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking lot not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Throwable $e) {
      return $this->respondErrorWithoutData(
          'Error deleting parking lot, please try again.',
          500
      );
    }
  }
}
