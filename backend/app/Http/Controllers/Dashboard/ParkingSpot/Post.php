<?php

namespace App\Http\Controllers\Dashboard\ParkingSpot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ParkingSpot\DeactivateSpotRequest;
use App\Http\Requests\Dashboard\ParkingSpot\StoreRequest;
use App\Services\Dashboard\ParkingSpotService;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post extends Controller
{
  use ApiResponse;

  /**
   * Create a new parking spot.
   *
   * Endpoint ini digunakan untuk membuat parking spot dengan dua mode:
   * - walk_in
   * - booking
   *
   * @group Parking Spot
   *
   * @authenticated
   *
   * @bodyParam name string required Nama parking spot. Example: A-01
   * @bodyParam parking_lot_id integer required ID parking lot. Example: 1
   * @bodyParam mode string required Mode parking spot (walk_in|booking). Example: walk_in
   *
   * @bodyParam capacity integer required
   * Jumlah kapasitas slot.
   * Wajib diisi jika mode = walk_in.
   * Example: 10
   *
   * @bodyParam booking_limit integer
   * Batas maksimal booking per hari.
   * Wajib diisi jika mode = booking.
   * Example: 5
   *
   * @bodyParam is_active boolean optional
   * Status parking spot (aktif / nonaktif).
   * Default: true
   * Example: true
   *
   * @response 201 {
   *   "status": true,
   *   "message": "Parking spot berhasil dibuat",
   *   "data": {
   *     "id": 1,
   *     "name": "A-01",
   *     "mode": "walk_in",
   *     "capacity": 10,
   *     "booking_limit": null,
   *     "is_active": true
   *   }
   * }
   *
   * @response 422 {
   *   "status": false,
   *   "message": "Validation error",
   *   "errors": {
   *     "capacity": [
   *       "Capacity wajib diisi untuk mode walk_in"
   *     ]
   *   }
   * }
   */

  public function store(StoreRequest $request, ParkingSpotService $parkingSpotService)
  {
    $data = $request->validated();

    try {
      $parkingSpot = $parkingSpotService->createParkingSpot($data);
  
      return $this->respondSuccess('Parking spot created successfully', $parkingSpot, 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking Lot not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error creating parking spot, please try again.', 500);
    }
  }

  /**
   * Activate Parking Spot
   *
   * Mengaktifkan kembali parking spot yang nonaktif.
   *
   * @group Parking Spot
   *
   * @urlParam id integer required ID parking spot.
   *
   * @response 200 {
   *   "id": 1,
   *   "spot_number": "A005",
   *   "status": "available"
   * }
   *
   * @response 400 {
   *   "message": "Cannot restore parking spot because its parking lot is inactive"
   * }
   */
  public function activateParkingSpot($id, ParkingSpotService $parkingSpotService)
  {
    try {
      $parkingSpot = $parkingSpotService->activateParkingSpot($id);
  
      return $this->respondSuccessWithoutData('Parking spot activated successfully', 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking spot not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error activating parking spot, please try again.', 500);
    }
  }

  /**
 * Deactivate Parking Spot
 *
 * Menonaktifkan parking spot (soft delete).
 *
 * @group Parking Spot
 *
 * @urlParam id integer required ID parking spot.
 *
 * @response 200 {
 *   "message": "Parking spot deactivated successfully"
 * }
 *
 * @response 400 {
 *   "message": "Only available or broken parking spots can be deactived"
 * }
 */
  public function deactivateParkingSpot(DeactivateSpotRequest $request, $id, ParkingSpotService $parkingSpotService)
  {
    $data = $request->validated();
    try {
      $parkingSpotService->deleteParkingSpot($id, $data);

      return $this->respondSuccessWithoutData('Parking spot deactived successfully', 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking spot not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Throwable $e) {
      return $this->respondErrorWithoutData(
          'Error deleting parking spot, please try again.',
          500
      );
    }
  }
}
