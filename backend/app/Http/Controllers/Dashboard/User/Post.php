<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\StoreRequest;
use App\Services\Dashboard\UserService;
use App\Traits\ApiResponse;

class Post extends Controller
{
  use ApiResponse;
  
  /**
   * Create User
   *
   * Membuat user baru.
   *
   * @group User Management
   *
   * @authenticated
   *
   * @bodyParam username string required Username user.
   * @bodyParam email string required Email user.
   * @bodyParam password string required min:8 Password user.
   * @bodyParam role string required Role user (admin/user).
   *
   * @response 201 {
   *   "id": 10,
   *   "username": "newuser",
   *   "email": "new@mail.com",
   *   "role": "user"
   * }
   *
   * @response 422 {
   *   "message": "The given data was invalid."
   * }
   */
  public function store(StoreRequest $request, UserService $userService)
  {
    $data = $request->validated();

    try {
      $user = $userService->createUser($data);
  
      return $this->respondSuccess('User created successfully', $user, 200);
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error creating user, please try again.', 500);
    }
  }
}
