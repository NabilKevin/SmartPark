<?php

namespace App\Http\Requests\Dashboard\ParkingSpot;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
  public function rules()
  {
    return [
      'custom_number' => [
        'array',
        'required_without:start_number,amount',
        Rule::prohibitedIf(fn () => request()->filled('start_number') || request()->filled('amount')),
      ],
      'custom_number.*' => 'integer|min:1',
      'start_number' => [
        'integer',
        'min:1',
        'required_without:custom_number',
        'required_with:amount',
        Rule::prohibitedIf(fn () => request()->filled('custom_number'))
      ],
      'amount' => [
        'integer',
        'min:1',
        'required_without:custom_number',
        'required_with:start_number',
        Rule::prohibitedIf(fn () => request()->filled('custom_number'))
      ],
      'parking_lot_id' => 'required|exists:parking_lots,id',
    ];
  }
}