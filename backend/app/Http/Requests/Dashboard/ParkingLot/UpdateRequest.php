<?php

namespace App\Http\Requests\Dashboard\ParkingLot;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'sometimes|string|max:255',
      'capacity' => 'sometimes|integer|min:1',
      'prefix' => 'sometimes|string|max:10',
    ];
  }
}