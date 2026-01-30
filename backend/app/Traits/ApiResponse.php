<?php 

namespace App\Traits;

trait ApiResponse
{
  public function respondSuccess($message, $data, $statusCode)
  {
    return response()->json([
      'success' => true,
      'message' => $message,
      'data' => $data
    ], $statusCode);
  }
  public function respondSuccessWithoutData($message, $statusCode)
  {
    return response()->json([
      'success' => true,
      'message' => $message
    ], $statusCode);
  }
  public function respondSuccessPagination($message, $data, $currentPage, $perPage, $total, $statusCode)
  {
    return response()->json([
      'success' => true,
      'message' => $message,
      'data' => $data,
      'pagination' => [
          'current_page' => $currentPage,
          'per_page' => $perPage,
          'total' => $total,
          'last_page' => ceil($total / $perPage)
      ]
    ], $statusCode);
  }
  public function respondError($message, $errors, $statusCode)
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'errors' => $errors
    ], $statusCode);
  }
  public function respondErrorWithoutData($message, $statusCode)
  {
    return response()->json([
      'success' => false,
      'message' => $message
    ], $statusCode);
  }
}