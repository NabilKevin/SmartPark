<?php

namespace App\Http\Requests\Dashboard\ParkingSpot;

use Illuminate\Foundation\Http\FormRequest;

class DeactivateSpotRequest extends FormRequest
{
  public function rules()
  {
    return [
      'deactivated_reason' => 'required|string|min:10'
    ];
  }
}