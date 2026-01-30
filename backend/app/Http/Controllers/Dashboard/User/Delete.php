<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\UserService;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Delete extends Controller
{
  use ApiResponse;

  /**
   * Delete User
   *
   * Menghapus user berdasarkan ID.
   *
   * @group User Management
   *
   * @authenticated
   *
   * @urlParam id int required ID user.
   *
   * @response 200 {
   *   "success": true
   * }
   *
   * @response 404 {
   *   "message": "User not found."
   * }
   */
  public function destroy($id, UserService $userService)
  {
    try {
      $userService->deleteUser($id);

      return $this->respondSuccessWithoutData('User deleted successfully', 200);
    } catch (ModelNotFoundException $e) {
      return $this->respondErrorWithoutData(
          'User not found',
          404
      );
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Throwable $e) {
      return $this->respondErrorWithoutData(
          'Error deleting user, please try again.',
          500
      );
    }
  }
}
