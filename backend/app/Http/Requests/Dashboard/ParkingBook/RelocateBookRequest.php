<?php

namespace App\Http\Requests\Dashboard\ParkingBook;

use Illuminate\Foundation\Http\FormRequest;

class RelocateBookRequest extends FormRequest
{
  public function rules()
  {
    return [
      'relocate_reason' => 'required|string|max:255',
      'parking_book_id' => 'required|integer|exists:parking_books,id',
      'to_parking_spot_id' => 'required|integer|exists:parking_spots,id',
    ];
  }
}