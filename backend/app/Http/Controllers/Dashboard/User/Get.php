<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Get extends Controller
{
  use ApiResponse;
  
  /**
   * Get Users
   *
   * Mengambil daftar user dengan pagination, pencarian, dan filter role.
   *
   * @group User Management
   *
   * @authenticated
   *
   * @queryParam perPage int Jumlah data per halaman. Default: 10
   * @queryParam search string Cari berdasarkan username.
   * @queryParam role string Filter berdasarkan role (admin, user).
   *
   * @response 200 {
   *   "current_page": 1,
   *   "data": [
   *     {
   *       "id": 1,
   *       "username": "john_doe",
   *       "email": "john@mail.com",
   *       "role": "user",
   *       "created_at": "2024-01-01T10:00:00Z"
   *     }
   *   ],
   *   "per_page": 10,
   *   "total": 25
   * }
   *
   * @response 401 {
   *   "message": "Unauthenticated."
   * }
   */
  public function index(Request $request, UserService $userService)
  {
    try {
      $users = $userService->getAllUsers($request);

      return $this->respondSuccess('Users retrieved successfully', $users, 200);
    } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error retrieving users, please try again.', 500);
    }
  }
}
