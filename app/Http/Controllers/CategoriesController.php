<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\File;
use App\Traits\Res;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

  use File, Res;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $categories = Category::paginate(6);

    return view('admin.categories.show', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.categories.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CategoryRequest $request)
  {
    $validatedData = $request->validated();
    $validatedData['image'] = $this->uploadFile($request, $this->categoriesPath, 'image');
    Category::create($validatedData);
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
    $category = Category::find($id);
    return $category;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $category = Category::find($id);
    return view('admin.categories.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
    $category = Category::find($id)->first();
    if ($category) {
      if (file_exists($category->image)) {
        unlink($category->image);
      }
      $category->destroy($id);
      return $this->sendRes('Category Deleted', true, $category->name);
    } else {
      return $this->sendRes('Some Thing Error', false);
    }
  }
}
