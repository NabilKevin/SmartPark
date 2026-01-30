<?php

namespace App\Http\Requests\User\ParkingBook;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
  public function rules()
  {
    return [
      'parking_spot_id' => 'required|integer|exists:parking_spots,id',
      'type' => 'required|in:booking,walk_in',
      'start_at' => [
        'required_if:type,booking', 
        'date_format:Y-m-d H:i:s',
        Rule::date()->afterOrEqual(today())
      ],
    ];
  }
}