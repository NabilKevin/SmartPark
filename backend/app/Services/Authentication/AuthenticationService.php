<?php

namespace App\Services\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticationService
{
  public function login($credentials)
  {
    if (!Auth::attempt($credentials)) {
      throw new \RuntimeException('Invalid username or password', 401);
    }

    $user = User::firstWhere('username', $credentials['username']);
    $token = $user->createToken('auth_token')->plainTextToken;

    return [
      'token' => $token,
      'user' => $user,
    ];
  }
  public function register($data)
  {
    $data['password'] = bcrypt($data['password']);

    $user = User::create($data);

    return $user;
  }
  public function logout($request)
  {
    return $request->user()->currentAccessToken()->delete();
  }
  public function me()
  {
    return Auth::user();
  }
  public function updateProfile($data)
  {
    $user = User::find(Auth::id());
    $user->update($data);
    return $user;
  }
}