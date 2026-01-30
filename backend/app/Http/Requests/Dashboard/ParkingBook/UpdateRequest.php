<?php

namespace App\Http\Requests\Dashboard\ParkingBook;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
  public function rules()
  {
    $id = $this->route('id');
    return [
      'username' => 'sometimes|string|max:255|unique:users,username,' . $id,
      'email' => 'sometimes|email|max:255|unique:users,email,' . $id,
      'role' => 'sometimes|in:admin,user'
    ];
  }
}