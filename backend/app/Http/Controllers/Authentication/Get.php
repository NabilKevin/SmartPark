<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Services\Authentication\AuthenticationService;
use App\Traits\ApiResponse;

class Get extends Controller
{
  use ApiResponse;

  /**
   * Get current user
   *
   * @group Authentication
   *
   * @authenticated
   *
   * @response 200 {
   *  "id": 1,
   *  "username": "admin",
   *  "email": "admin@mail.com"
   * }
   */
  public function me(AuthenticationService $authenticationService)
  {
    try {
        $data = $authenticationService->me();

        return $this->respondSuccess('Successfully get profile', $data, 200);
      } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
      } catch (\Exception $e) {
        return $this->respondErrorWithoutData('Error get profile, please try again.', 500);
      }
  }
}
