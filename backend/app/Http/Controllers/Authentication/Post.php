<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Services\Authentication\AuthenticationService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Post extends Controller
{
  use ApiResponse;

  /**
   * Login user
   *
   * @group Authentication
   *
   * @bodyParam username string required Username user. Example: admin
   * @bodyParam password string required Password user. Example: password123
   *
   * @response 200 {
   *  "token": "1|xxxxxxxxxxxxxxxx",
   *  "user": {
   *    "id": 1,
   *    "username": "admin",
   *    "email": "admin@mail.com"
   *  }
   * }
   *
   * @response 401 {
   *  "message": "Invalid username or password"
   * }
   */
  public function login(LoginRequest $request, AuthenticationService $authenticationService)
  {
    $credentials = $request->validated();

    try {
      $response = $authenticationService->login($credentials);

      return $this->respondSuccess('Successfully logged in', $response, 200);
    } catch (\RuntimeException $e) {
      return $this->respondErrorWithoutData($e->getMessage(), 401);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error logging in, please try again.', 500);
    }
  }

  /**
   * Register user
   *
   * @group Authentication
   *
   * @bodyParam username string required
   * @bodyParam email string required
   * @bodyParam password string required min:8 confirmed
   *
   * @response 201 {
   *  "id": 1,
   *  "username": "admin",
   *  "email": "admin@mail.com"
   * }
   */
  public function register(RegisterRequest $request, AuthenticationService $authenticationService)
  {
    $data = $request->validated();

    try {
      $user = $authenticationService->register($data);

      return $this->respondSuccess('User registered successfully', $user, 200);
    } catch (\RuntimeException $e) {
      return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error registering user, please try again.', 500);
    }
  }

  /**
   * Logout user
   *
   * @group Authentication
   *
   * @authenticated
   *
   * @response 200 true
   */

  public function logout(AuthenticationService $authenticationService, Request $request)
  {
    try {
      $authenticationService->logout($request);

      return $this->respondSuccessWithoutData('Successfully logged out', 200);
    } catch (\RuntimeException $e) {
      return $this->respondErrorWithoutData($e->getMessage(), 400);
    } catch (\Exception $e) {
      return $this->respondErrorWithoutData('Error logging out, please try again.', 500);
    }
  }
}
