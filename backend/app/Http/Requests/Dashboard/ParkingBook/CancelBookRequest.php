<?php

namespace App\Http\Requests\Dashboard\ParkingBook;

use Illuminate\Foundation\Http\FormRequest;

class CancelBookRequest extends FormRequest
{
  public function rules()
  {
    return [
      'reason' => 'required|string|max:255',
      'parking_book_id' => 'required|integer|exists:parking_books,id',
    ];
  }
}