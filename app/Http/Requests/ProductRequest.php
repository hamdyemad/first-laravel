<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(Request $request)
  {
    $rules = [
      'name' => ['required', 'max:255', Rule::unique('products', 'name')],
      'cat_id' => ['required'],
      'image' => ['image', 'required'],
      'description' => ['required', 'max:255'],
      'price' => ['required', 'numeric', 'min:1']
    ];
    if ($request->id) {
      $product = Product::find($request->id);
      $rules['name'] = ['required', 'max:255', Rule::unique('products', 'name')->ignore($request->id)];
      if ($product->hasImage()) {
        $rules['image'] = ['image'];
      }
    }
    return $rules;
  }
}
