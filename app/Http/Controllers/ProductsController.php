<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\File;
use App\Traits\Res;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{


  use File, Res;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::paginate(6);
    //
    return view('admin.products.show', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $categories = Category::all();
    return view('admin.products.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProductRequest $request)
  {
    $validatedData = $request->validated();
    $validatedData['image'] = $this->uploadFile($request, $this->productsPath, 'image');
    Product::create($validatedData);
    return redirect()->back()->with(["heading" => stringCutter(20, $request->name), "message" => "Has Been Added Successfully !"]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
    $product = Product::find($id);
    return $product;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
    $product = Product::find($id);
    $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ProductRequest $request, $id)
  {

    $validatedData = $request->validated();
    $product = Product::find($id);
    if (file_exists($product->image) && $request['image']) {
      unlink($product->image);
      $validatedData['image'] = $this->uploadFile($request, $this->productsPath, 'image');
    }
    $product->update($validatedData);
    return redirect()->back()->with(["heading" => stringCutter(20, $request->name), "message" => "Has Been Updated Successfully !"]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $product = Product::find($id);
    if ($product) {
      if (file_exists($product->image)) {
        unlink($product->image);
      }
      $product->destroy($id);
      return $this->sendRes("Has Been Deleted Successfully!", true, ['name' => stringCutter(10, $product->name)]);
    } else {
      return $this->sendRes('There Is no Products like this id', false, []);
    }
  }
}
