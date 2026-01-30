<?php

namespace App\Http\Controllers\Dashboard\ParkingBook;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ParkingBook\CancelBookRequest;
use App\Http\Requests\Dashboard\ParkingBook\RelocateBookRequest;
use App\Http\Requests\Dashboard\ParkingBook\StoreRequest;
use App\Services\Dashboard\ParkingBookService;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post extends Controller
{
  use ApiResponse;
  
  /**
   * Create parking booking
   *
   * @group Parking Book
   * @authenticated
   *
   * @bodyParam parking_spot_id integer required Example: 3
   * @bodyParam user_id integer required Example: 3
   * @bodyParam start_at string required Example: 2026-01-30 10:00:00
   *
   * @response 200 {
   *  "id": 10,
   *  "status": "booked",
   * }
   *
   * @response 400 {
   *  "message": "Parking spot is not available"
   * }
   */
  public function store(StoreRequest $request, ParkingBookService $parkingBookService)
  {
    $data = $request->validated();

    try {
      $parkingBook = $parkingBookService->createParkingBook($data);

      return $this->respondSuccess('Parking book created successfully', $parkingBook, 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking Spot not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error creating parking book, please try again.', 500);
    }
  }

  /**
   * Cancel parking booking
   *
   * @group Parking Book
   * @authenticated
   *
   * @bodyParam parking_book_id integer required Example: 5
   * @bodyParam reason string required Example: Change of plan
   *
   * @response 200 {
   *  "id": 1,
   *  "cancellation_type": "user_cancelled"
   * }
   */
  public function cancelBooking(CancelBookRequest $request, ParkingBookService $parkingBookService)
  {
    $data = $request->validated();

    try {
      $cancellation = $parkingBookService->cancelBooking($data);

      return $this->respondSuccess('Parking book cancelled successfully', $cancellation, 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking book not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error cancelling parking book, please try again.', 500);
    }
  }

  
  /**
   * Relocate parking booking
   *
   * @group Parking Book
   * @authenticated
   *
   * @bodyParam parking_book_id integer required Example: 5
   * @bodyParam to_parking_spot_id integer required Example: 8
   * @bodyParam relocate_reason string required Example: Spot maintenance
   *
   * @response 200 {
   *  "id": 2,
   *  "status": "active"
   * }
   */
  public function relocateBooking(RelocateBookRequest $request, ParkingBookService $parkingBookService)
  {
    $data = $request->validated();

    try {
      $relocation = $parkingBookService->relocateBooking($data);

      return $this->respondSuccess('Parking book relocated successfully', $relocation, 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'Parking book not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error relocating parking book, please try again.', 500);
    }
  }

}
