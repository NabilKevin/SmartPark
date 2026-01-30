<?php

namespace App\Http\Requests\Dashboard\ParkingBook;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
  public function rules()
  {
    return [
      'parking_spot_id' => 'required|integer|exists:parking_spots,id',
      'user_id' => 'required|integer|exists:users,id',
      'start_at' => 'required|date_format:Y-m-d H:i:s',
    ];
  }
}