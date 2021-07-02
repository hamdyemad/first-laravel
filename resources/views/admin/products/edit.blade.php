@extends('layouts.app')

@section('content')
<div class="edit-product">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('products.showAll') }}">Products</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ stringCutter(10,$product->name) }}</li>
    </ol>
  </nav>
  <div class="container-fluid">
    <h2>Edit {{ stringCutter(10,$product->name) }}</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control
            @error('name') is-invalid @enderror @if(old('name')) is-valid @endif" value="{{ $product->name }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="category">Category</label>
            <select name="cat_id" class="custom-select @error('cat_id') is-invalid @enderror @if(old('cat_id')) is-valid @endif">
              @foreach($categories as $category)
              <option value="{{ $category->id }}" @if($category->id == $product->cat_id) selected @endif>{{$category->name}}</option>
              @endforeach
            </select>
            @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description"placeholder="Description" class="form-control
            @error('description') is-invalid @enderror @if(old('description')) is-valid @endif">{{ $product->description }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="name">Price</label>
            <input type="text" name="price" value="{{ $product->price }}" placeholder="Price" class="form-control @error('price') is-invalid @enderror @if(old('price')) is-valid @endif">
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="Image">Image</label>
            <div class="file-info">
              <button type="button" class="btn btn-info btn-block" id="selectBtn">{{ $product->image }}</button>
              <input type="file" hidden name="image" id="file" value="{{ $product->image }}">
              <img src="/{{$product->image}}" alt="">
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col">
          <button class="btn btn-info">Edit</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('script')
@parent
<script>
  @if(Session::has('message'))
    toastr.info("{{ session('message') }}", "{{ session('heading') }}")
  @endif
</script>
@endsection
