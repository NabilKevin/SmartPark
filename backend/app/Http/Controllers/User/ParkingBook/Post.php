<?php

namespace App\Http\Controllers\User\ParkingBook;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ParkingBook\StoreRequest;
use App\Services\User\ParkingBookService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Post extends Controller
{
  use ApiResponse;

  /**
   * Create parking book
   *
   * Membuat booking parkir atau walk-in.
   * User hanya boleh parkir atau booking 1x dalam 1 hari.
   *
   * @group Parking Book
   * @authenticated
   *
   * @bodyParam parking_spot_id integer required ID parking spot. Example: 5
   * @bodyParam type string required Jenis booking. Enum: walk_in, booking. Example: walk_in
   * @bodyParam start_at datetime required_if:type,booking Format: Y-m-d H:i:s. Example: 2026-02-01 10:00:00
   *
   * @response 201 {
   *   "message": "Parking booked successfully",
   *   "data": {
   *     "id": 15,
   *     "user_id": 3,
   *     "parking_spot_id": 5,
   *     "type": "walk_in",
   *     "status": "active",
   *     "booked_at": "2026-02-01 09:10:00",
   *     "checkin_at": "2026-02-01 09:10:00"
   *   }
   * }
   *
   * @response 400 {
   *   "message": "Parking spot is not available"
   * }
   *
   * @response 400 {
   *   "message": "You already booked or park today!"
   * }
   */
  public function store(StoreRequest $request, ParkingBookService $parkingBookService)
  {
    $data = $request->validated();
    try {
        $data = $parkingBookService->createParkingBook($data);

        return $this->respondSuccess('Successfully create book', $data, 200);
      } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
      } catch (\Exception $e) {
        return $this->respondErrorWithoutData('Error create book, please try again.', 500);
      }
  }

  /**
   * Checkout parking
   *
   * Digunakan saat user keluar dari area parkir.
   * Hanya bisa dilakukan jika status masih active.
   *
   * @group Parking Book
   * @authenticated
   *
   * @urlParam id integer required ID parking book. Example: 12
   *
   * @response 200 {
   *   "message": "Checkout successful",
   *   "data": {
   *     "id": 12,
   *     "status": "completed",
   *     "checked_at": "2026-02-01 12:15:00"
   *   }
   * }
   *
   * @response 400 {
   *   "message": "You already checked out or book cancelled"
   * }
   */
  public function checkout(ParkingBookService $parkingBookService, $id)
  {
    try {
        $parkingBookService->checkout($id);

        return $this->respondSuccessWithoutData('Successfully checkout', 200);
      } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
      } catch (\Exception $e) {
        return $this->respondErrorWithoutData('Error checkout, please try again.', 500);
      }
  }
}
