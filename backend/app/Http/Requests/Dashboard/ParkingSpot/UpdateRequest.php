<?php

namespace App\Http\Requests\Dashboard\ParkingSpot;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
  public function rules()
  {
    return [
      'number' => 'sometimes|integer|min:1',
      'status' => 'sometimes|in:available,occupied,reserved,broken',
    ];
  }
}