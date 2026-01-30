<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\UpdateRequest;
use App\Services\Authentication\AuthenticationService;
use App\Traits\ApiResponse;

class Put extends Controller
{
  use ApiResponse;

  /**
   * Update profile
   *
   * @group Authentication
   *
   * @authenticated
   *
   * @bodyParam username string
   * @bodyParam email string
   * @bodyParam password string confirmed min:8
   *
   * @response 200 {
   *  "id": 1,
   *  "username": "new_username",
   *  "email": "new@mail.com"
   * }
   */
  public function update(UpdateRequest $request, AuthenticationService $authenticationService)
  {
    $data = $request->validated();
    try {
        $data = $authenticationService->updateProfile($data);

        return $this->respondSuccess('Successfully updated profile', $data, 200);
      } catch (\RuntimeException $e) {
        return $this->respondErrorWithoutData($e->getMessage(), 400);
      } catch (\Exception $e) {
        return $this->respondErrorWithoutData('Error update profile, please try again.', 500);
      }
  }
}
