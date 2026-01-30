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
