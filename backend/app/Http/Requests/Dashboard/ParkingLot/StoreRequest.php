<?php

namespace App\Http\Requests\Dashboard\ParkingLot;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'required|string|max:255',
      'capacity' => 'required|integer|min:1',
      'prefix' => 'required|string|max:10',
    ];
  }
}