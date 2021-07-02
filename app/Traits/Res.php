<?php

namespace App\Traits;



trait Res
{

  public $categoriesPath = 'images/categories/';
  public $productsPath = 'images/products/';

  public function sendRes($message, $status = true,  $data = [])
  {
    return response()->json([
      'status' => $status,
      'message' => $message,
      'data' => $data
    ]);
  }
}
