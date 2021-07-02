@extends('layouts.app')

@section('content')
<div class="edit-category">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('categories.showAll') }}">Categories</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ stringCutter(10,$category->name) }}</li>
    </ol>
  </nav>
  <div class="container-fluid">
    <h2>Edit {{ stringCutter(10,$category->name) }}</h2>
    <form action="{{ route('products.update', $category->id) }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control
            @error('name') is-invalid @enderror @if(old('name')) is-valid @endif" value="{{ $category->name }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="Image">Image</label>
            <div class="file-info">
              <button type="button" class="btn btn-info btn-block" id="selectBtn">{{ $category->image }}</button>
              <input type="file" hidden name="image" id="file" value="{{ $category->image }}">
              <img src="/images/categories/{{$category->image}}" alt="">
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="about">About</label>
            <textarea name="about"placeholder="About" class="form-control
            @error('about') is-invalid @enderror @if(old('about')) is-valid @endif">{{ $category->about }}</textarea>
            @error('about')
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
