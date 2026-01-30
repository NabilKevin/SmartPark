<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
  public function rules()
  {
    $id = Auth::id();
    return [
      'username' => 'sometimes|string|max:255|unique:users,username,' . $id,
      'email' => 'sometimes|email|max:255|unique:users,email,' . $id,
      'role' => 'sometimes|in:admin,user',
      'password' => 'nullable|min:8|confirmed'
    ];
  }
}