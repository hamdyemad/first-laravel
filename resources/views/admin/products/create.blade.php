@extends('layouts.app')

@section('content')
<div class="create-product">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('products.showAll') }}">Products</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
  </nav>
  <div class="container-fluid">
    <h2>Create Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control
            @error('name') is-invalid @enderror @if(old('name')) is-valid @endif" value="{{ old('name') }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="category">Category</label>
            <select name="cat_id" class="custom-select @error('cat_id') is-invalid @enderror @if(old('cat_id')) is-valid @endif">
              <option value="">Select Category</option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}" @if(old('cat_id') == $category->id) selected @endif>
                {{$category->name}}
                <img src="/images/logo.png" alt="">
              </option>
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
            @error('description') is-invalid @enderror @if(old('description')) is-valid @endif">{{ old('description') }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="name">Price</label>
            <input type="text" name="price" value="{{ old('price') }}" placeholder="Price" class="form-control @error('price') is-invalid @enderror @if(old('price')) is-valid @endif">
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="Image">Image</label>
            <div class="file-info">
              <button type="button" class="btn btn-info btn-block" id="selectBtn">Select Image</button>
              <input type="file" hidden name="image" id="file">
              <img hidden src="" alt="">
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col">
          <button class="btn btn-success">Create</button>
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
    toastr.success("{{ session('message') }}", "{{ session('heading') }}")
  @endif
</script>
@endsection
