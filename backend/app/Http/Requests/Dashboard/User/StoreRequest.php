<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
  public function rules()
  {
    return [
      'username' => 'required|string|max:255|unique:users,username',
      'email' => 'required|string|max:255|unique:users,email',
      'password' => 'required|string|min:8|confirmed',
      'role' => 'required|in:admin,user'
    ];
  }
}