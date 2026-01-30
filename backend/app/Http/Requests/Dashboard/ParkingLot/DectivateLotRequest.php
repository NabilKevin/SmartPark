<?php

namespace App\Http\Requests\Dashboard\ParkingLot;

use Illuminate\Foundation\Http\FormRequest;

class DectivateLotRequest extends FormRequest
{
  public function rules()
  {
    return [
      'deactivated_reason' => 'required|string|min:10'
    ];
  }
}