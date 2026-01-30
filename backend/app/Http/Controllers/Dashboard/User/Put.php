<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Services\Dashboard\UserService;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Put extends Controller
{
  use ApiResponse;

  /**
   * Update User
   *
   * Memperbarui data user.
   *
   * @group User Management
   *
   * @authenticated
   *
   * @urlParam id int required ID user.
   *
   * @bodyParam username string Username user.
   * @bodyParam email string Email user.
   * @bodyParam role string Role user.
   *
   * @response 200 {
   *   "id": 1,
   *   "username": "updated_name",
   *   "email": "updated@mail.com",
   *   "role": "admin"
   * }
   *
   * @response 404 {
   *   "message": "User not found."
   * }
   */
  public function update(UpdateRequest $request, UserService $userService, $id)
  {
    $data = $request->validated();
    
    try {
      $user = $userService->updateUser($id, $data);

      return $this->respondSuccess('User updated successfully', $user, 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'User not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error updating user, please try again.', 500);
    }
  }
}
